<?php

namespace App\Data\Repositories;

use App\Models\Avatar as AvatarModel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\TemporaryUploadedFile;
use phpDocumentor\Reflection\Types\String_;
use Illuminate\Support\Facades\File;

class Avatars extends Repository
{
    protected $model = AvatarModel::class;

    /**
     * @param $file
     * @param $uploadedFile
     * @return bool
     */
    protected function fileExists($file, $uploadedFile): bool
    {
        return Storage::disk($this->getDrive())->exists(
            $this->makePath($file->hash, $uploadedFile)
        );
    }

    protected function findOrCreateFile($uploadedFile)
    {
        return $file;
    }

    private function makeDirectory($hash)
    {
        return make_deep_path($hash);
    }

    /**
     * @param $file
     * @param $uploadedFile
     */
    protected function storeFile($file, $uploadedFile): void
    {
        if (!$this->fileExists($file, $uploadedFile)) {
            $uploadedFile->storeAs(
                $this->makeDirectory($file->hash),
                $this->makeFileName($file->hash, $uploadedFile),
                $this->getDrive()
            );
        }
    }

    function getBase64Extension($base64String)
    {
        if (preg_match('/^data:image\/(\w+);base64,/', $base64String, $matches)) {
            return $matches[1];
        }

        return null;
    }

    protected function getMimeType($base64String)
    {
        dd(File::mimeTypeFromBase64($base64String));
        $finfo = new finfo(FILEINFO_MIME_TYPE);

        // Get the MIME type using finfo
        return $mime = $finfo->buffer($base64String);
    }

    /**
     * @param $uploadedFile
     * @return File
     */
    public function storePhysicalFile($uploadedFile)
    {
        $base64String = $uploadedFile;
        $fileContent = base64_decode(substr($base64String, strpos($base64String, ',') + 1));
        $hash = sha1($fileContent);

        $extension = Str::lower($this->getBase64Extension($base64String));

        Storage::disk($this->getDrive())->put(
            $path = $this->makePath($hash, $fileContent, $extension),
            $fileContent
        );

        if (!($file = $this->model::where('hash', $hash)->first())) {
            $file = new $this->model();
            $file->hash = $hash;
            $file->drive = $this->getDrive();
            $file->path = $path;
            $file->mime_type = mime_content_type(Storage::disk($this->getDrive())->path($path));
            $file->save();
        }
        return $file;
    }

    private function getDrive()
    {
        return 'avatars';
    }

    /**
     * @param $hash
     * @param $fileContent
     * @return string
     */
    private function makeFileName($hash, $fileContent, $extension): string
    {
        return $hash . '.' . $extension;
    }

    /**
     * @param $hash
     * @param $fileContent
     * @return string
     */
    private function makePath($hash, $fileContent, $extension): string
    {
        $deep = $this->makeDirectory($hash);

        $filename = $this->makeFileName($hash, $fileContent, $extension);

        return "{$deep}{$filename}";
    }
}
