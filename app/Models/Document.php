<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;


class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'person_id',
        'document_type_id',
        'number',
        'state_id',
        ];


    public function documentType()
    {
        return $this->belongsTo(DocumentType::class,'document_type_id');
    }


    public function person()
    {
        return $this->belongsTo(Person::class,'person_id');
    }



}
