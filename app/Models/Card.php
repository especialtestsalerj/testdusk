<?php

namespace App\Models;
use App\Models\Scopes\Active;
use App\Services\QrCode\Service;
use Ramsey\Uuid\Uuid;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Scopes\InCurrentBuilding;

class Card extends Model
{
    protected $fillable = ['uuid', 'number', 'is_active', 'is_anonymous'];
    public static function boot()
    {
        parent::boot();
        static::addGlobalScope(new Active());
    }
    public function visitors()
    {
        return $this->belongsToMany(Visitor::class);
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
}
