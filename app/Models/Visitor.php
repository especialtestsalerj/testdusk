<?php

namespace App\Models;
use App\Services\QrCode\Service;
use Ramsey\Uuid\Uuid;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Builder;

class Visitor extends Model
{
    protected $fillable = [
        'routine_id',
        'entranced_at',
        'exited_at',
        'person_id',
        'description',
        'document_id',
        'avatar_id',
    ];

    protected $casts = [
        'entranced_at' => 'datetime:Y-m-d H:i',
        'exited_at' => 'datetime:Y-m-d H:i',
    ];

    protected static function booted()
    {
        static::creating(fn(Visitor $visitor) => ($visitor->uuid = (string) Uuid::uuid4()));
    }

    public static function findByUuid($uuid)
    {
        return self::where('uuid', $uuid)->first();
    }

    public function person()
    {
        return $this->belongsTo(Person::class, 'person_id');
    }

    public function cautions()
    {
        return $this->hasMany(Caution::class);
    }


    public function sectors()
    {
        return $this->belongsToMany(Sector::class);
    }

    public function getSectorsResumedAttribute()
    {
        $othersSectors = '';
        if(count($this->sectors) > 1){
            $othersSectors = ' +'. count($this->sectors) - 1;
        }

        //dd( $this->sectors);
        return $this->sectors?->first()?->name . $othersSectors;
    }

    public function getEntrancedAtFormattedAttribute()
    {
        return $this->entranced_at?->format('Y-m-d H:i');
    }

    public function getEntrancedAtBrFormattedAttribute()
    {
        return $this->entranced_at?->format('d/m/Y H:i');
    }

    public function getExitedAtFormattedAttribute()
    {
        return $this->exited_at?->format('Y-m-d H:i');
    }

    public function hasPending()
    {
        return isset($this?->old_id);
    }

    public function hasOpenCaution($caution_id = null)
    {
        return $this->cautions()
            ->whereRaw(isset($caution_id) ? 'cautions.id <> ' . $caution_id : '1=1')
            ->whereNull('cautions.concluded_at')
            ->count() > 0;
    }

    public function document()
    {
        return $this->belongsTo(Document::class);
    }

    public function loadLatestPhoto()
    {
        if ($this->person_id) {
            $latestVisitor = Visitor::where('person_id', $this->person_id)
                ->orderBy('created_at', 'desc')
                ->first();

            $this->avatar_id = $latestVisitor->avatar_id ?? null;
        }
        return $this;
    }

    public function hasPhoto(): Attribute
    {
        return Attribute::make(get: fn($value) => !!$this->avatar_id);
    }

    public function photo(): Attribute
    {
        $avatar = $this->avatar;

        return Attribute::make(get: fn($value) => $this->avatar ? $avatar->base64Uri : no_photo());
    }

    public function photoTable(): Attribute
    {
        $avatar = $this->avatar;

        return Attribute::make(
            get: fn($value) => $this->avatar ? $avatar->base64Uri : no_photo_table()
        );
    }

    public function avatar()
    {
        return $this->belongsTo(Avatar::class);
    }

    public function qrCodeUri(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $this->id
                ? app(Service::class)->generate(route('visitors.card', ['uuid' => $this->uuid]))
                : app(Service::class)->generate(
                    route('visitors.card', [
                        'timestamp' => $this->entranced_at->timestamp ?? now(),
                    ])
                )
        );
    }

    public function checkout($checkoutTime = null)
    {
        $success = false;

        if (!$this->exited_at) {
            $this->exited_at = $checkoutTime ?? now();
            $this->save();
            $success = true;
        }

        return $success;
    }

    public function scopeWasThereBetweenDates(Builder $query, $startDate, $endDate): void
    {
        // Check if both $startDate and $endDate are provided
        if ($startDate && $endDate) {
            $query->whereRaw(
                '(("entranced_at" >= ? and "entranced_at" <= ?) or ("exited_at" >= ? and "exited_at" <= ?))',
                [$startDate, $endDate, $startDate, $endDate]
            );
        }
        // Check if only $startDate is provided
        elseif ($startDate) {
            $query->where(
                fn($query) => $query
                    ->orWhere('entranced_at', '>=', $startDate)
                    ->orWhere('exited_at', '>=', $startDate)
            );
        }
        // Check if only $endDate is provided
        elseif ($endDate) {
            $query->where(
                fn($query) => $query
                    ->orWhere('entranced_at', '<=', $endDate)
                    ->orWhere('exited_at', '<=', $endDate)
            );
        }
    }

    public function scopeOpen(Builder $query): void
    {
        $query->whereNull('exited_at');
    }

    public function hasPendingVisit()
    {
        return Visitor::where('person_id', $this->person_id)
            ->whereNull('exited_at')
            ->exists();
    }
}
