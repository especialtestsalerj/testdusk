<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'person_id',
        'document_type_id',
        'number',
        'state_id',
        'issuing_authority',
        'created_by_id',
        'updated_by_id',
    ];

    protected $appends = [ 'type'];

    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    public function documentType()
    {
        return $this->belongsTo(DocumentType::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by_id');
    }

    public function type(): Attribute
    {
        return Attribute::make(get: fn($value) => $this->documentType->name);
    }

    public function visitors()
    {
        return $this->hasMany(Visitor::class);
    }
}
