<?php

namespace App\Models;

use App\Exceptions\ModelNotFound;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Number;

class File extends Model
{
    protected $fillable = ['size', 'hash', 'drive', 'path', 'mime_type'];
    protected $appends = ['url', 'size_normalized'];

    public static function getFileClassForHash($hash)
    {
        $file = self::where('hash', $hash)->first();

        $attachedFile = $file->attachedFile()->get()->load('fileable')->whereNotNull('fileable')->first();

        if (!$file || !$attachedFile) {
            throw new ModelNotFound('No model found with hash ' . $hash);
        }

        $fileable = $attachedFile->fileable;

        if (!$fileable) {
            throw new ModelNotFound('No model found with hash ' . $hash);
        }

        return ['fileable' => $fileable, 'attachedFile' => $attachedFile, 'file' => $file];
    }
    public function getUrlAttribute()
    {
        return Storage::disk($this->drive)->url($this->path);
    }

    public function attachedFile(): HasOne
    {
        return $this->hasOne(AttachedFile::class);
    }

    public function extension(): Attribute
    {
        return Attribute::make(
            get: fn() => extract_extension_from_file_name($this->path)
        );
    }

    protected function fileProperties(): Attribute
    {
        $mimeType = $this->mime_type;
        $ext = $this->extension;
        $fileName = $this->hash . '.' . $ext;
        $path = make_deep_path($this->hash) . '/' . $fileName;

        return Attribute::make(
            get: fn() => [
                'mimeType' => $mimeType,
                'extension' => $ext,
                'fileName' => $fileName,
                'path' => $path,
                'originalName' => $this->attachedFile->original_name,
            ]
        );
    }

    public function sizeNormalized(): Attribute
    {
        return Attribute::make(
            get: fn() => format_file_size($this->size)
        );
    }
}
