<?php

namespace App\Models;
use App\Http\Requests\CardDestroy;
use App\Models\Scopes\Active;
use App\Services\QrCode\Service;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Scopes\InCurrentBuilding;

class Card extends Model
{
    protected $fillable = ['uuid', 'number', 'status', 'is_anonymous', 'building_id'];
    public static function boot()
    {
        parent::boot();
        static::addGlobalScope(new Active());
    }

    protected static function booted()
    {
        static::creating(function (Card $card) {
            $card->uuid = (string) Uuid::uuid4();
        });
    }

    public function visitors()
    {
        return $this->hasMany(Visitor::class);
    }

    public function building()
    {
        return $this->belongsTo(Building::class);
    }

    public static function findByUuid($uuid)
    {
        return self::where('uuid', $uuid)->first();
    }

    public function qrCodeUri($size, $margin)
    {
        return app(Service::class)->generate(
            route('cards.card', ['uuid' => $this->uuid]),
            $size,
            $margin
        );
    }

    public function canDelete()
    {
        $request = new CardDestroy($this->toArray());

        return Validator::make($request->all(), $request->rules())->fails();
    }
}
