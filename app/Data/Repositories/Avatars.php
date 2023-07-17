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

    private function makeDirectory($hash)
    {
        return make_deep_path($hash);
    }

    function getBase64Extension($base64String)
    {
        if (preg_match('/^data:image\/(\w+);base64,/', $base64String, $matches)) {
            return $matches[1];
        }

        return null;
    }

    /**
     * @param $uploadedFile
     * @return File
     */
    public function store($base64String)
    {
        $fileContent = $this->extractFileContent($base64String);
        $hash = $this->hashContent($fileContent);

        $extension = $this->getExtension($base64String);
        $path = $this->storePhysicalFile($hash, $fileContent, $extension);

        if (!($file = $this->findByHash($hash))) {
            $file = new $this->model();
            $file->hash = $hash;
            $file->drive = $this->getDrive();
            $file->path = $path;
            $file->mime_type = $this->getMimeType($path);
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

    /**
     * @param string $path
     * @return false|string
     */
    protected function getMimeType(string $path): string|false
    {
        return mime_content_type(Storage::disk($this->getDrive())->path($path));
    }

    /**
     * @param string $hash
     * @return mixed
     */
    protected function findByHash(string $hash)
    {
        return $this->model::where('hash', $hash)->first();
    }

    /**
     * @param string $hash
     * @param bool|string $fileContent
     * @param string $extension
     * @return string
     */
    protected function storePhysicalFile(
        string $hash,
        bool|string $fileContent,
        string $extension
    ): string {
        Storage::disk($this->getDrive())->put(
            $path = $this->makePath($hash, $fileContent, $extension),
            $fileContent
        );
        return $path;
    }

    /**
     * @param $base64String
     * @return string
     */
    protected function getExtension($base64String): string
    {
        return Str::lower($this->getBase64Extension($base64String));
    }

    /**
     * @param $base64String
     * @return false|string
     */
    protected function extractFileContent($base64String): string|false
    {
        return base64_decode(substr($base64String, strpos($base64String, ',') + 1));
    }

    /**
     * @param bool|string $fileContent
     * @return string
     */
    protected function hashContent(bool|string $fileContent): string
    {
        return sha1($fileContent);
    }
}
