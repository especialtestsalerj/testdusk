<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
class AttachedFile extends Model
{
    use SoftDeletes;

    protected $fillable = ['file_id', 'fileable_id', 'fileable_type', 'original_name', 'mime_type', 'deleted_at'];

    protected $with = ['file'];

    protected $dates = ['deleted_at'];

    public static function boot()
    {
        parent::boot();
        self::bootSoftDeletes();
    }

    public function fileable()
    {
        return $this->morphTo();
    }

    public function file()
    {
        return $this->belongsTo(File::class);
    }
}
