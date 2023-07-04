<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Avatar extends Model
{
    use HasFactory;
    protected $controlCreatedBy = false;
    protected $controlUpdatedBy = false;

    protected $fillable = ['hash', 'drive', 'path', 'mime_type'];

    protected $appends = ['url'];

    public function getUrlAttribute()
    {
        return config("filesystems.disks.{$this->drive}.url_prefix") . $this->path;
    }
}
