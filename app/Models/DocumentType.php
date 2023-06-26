<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;


class DocumentType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status',
    ];

    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

}
