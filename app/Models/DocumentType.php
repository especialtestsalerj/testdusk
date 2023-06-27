<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class DocumentType extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'status', 'created_by_id', 'updated_by_id'];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by_id');
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }
}
