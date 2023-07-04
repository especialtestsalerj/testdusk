<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;

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

    public function getDrive()
    {
        return 'avatars';
    }

    public function base64Uri(): Attribute
    {
        return Attribute::make(
            get: fn($value) => 'data:image/' .
                mime2ext($this->mime_type) .
                ';base64,' .
                base64_encode(Storage::disk('avatars')->get($this->path))
        );
    }
}
