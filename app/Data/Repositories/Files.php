<?php

namespace App\Data\Repositories;

use App\Models\AttachedFile;
use App\Models\File as FileModel;
use App\Models\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\TemporaryUploadedFile;
use Illuminate\Support\Facades\File as FileFacade;
class Files extends Repository
{
    protected $model = FileModel::class;

    /**
     * @param $model
     * @param $file
     * @param $originalName
     * @return \App\Models\AttachedFile
     */
    public function createAttachment($model, $file, $originalName): AttachedFile
    {
        return AttachedFile::firstOrCreate(
            [
                'file_id' => $file->id,
                'fileable_id' => $model->id,
                'fileable_type' => get_class($model),
            ],

            [
                'original_name' => $originalName,
            ]
        );
    }

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

    private function findOrCreateFile($uploadedFile)
    {
        if(is_array($uploadedFile)){
            //dropzone
            $pathName = $uploadedFile['path'];
            $mime = ext2mime($uploadedFile['extension']);
            $size = $uploadedFile['size'];
        }
        elseif($uploadedFile instanceof  TemporaryUploadedFile){
            //Livewire
            $pathName = $uploadedFile->getRealPath();
            $mime = $uploadedFile->getClientMimeType();
            $size = null; //TODO: consertar
        }else {
            $pathName = $uploadedFile->getPathName();
            $mime = $uploadedFile->getClientMimeType();
            $size = null; //TODO: consertar
        }

        $hash = sha1(file_get_contents($pathName));

        if (!($file = $this->findByHash($hash))) {
            $file = new $this->model;

            $file->hash = $hash;

            $file->drive = $this->getDrive();

            $file->path = $this->makePath($hash, $uploadedFile);

            $file->mime_type = $mime;
            $file->size = $size;

            $file->save();
        }

        return $file;
    }

    public function findByHash($hash)
    {
        return $this->model::where('hash', $hash)->first();
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
            if(is_array($uploadedFile)){
                Storage::makeDirectory(config("filesystems.disks.documents.sub_dir").'/'.($subDir = $this->makeDirectory($file->hash)));
                FileFacade::move($uploadedFile['path'], config("filesystems.disks.documents.root").'/'.$subDir.$this->makeFileName($file->hash, $uploadedFile));
            }else{
                $uploadedFile->storeAs(
                    $this->makeDirectory($file->hash),
                    $this->makeFileName($file->hash, $uploadedFile),
                    $this->getDrive()
                );
            }
        }
    }

    /**
     * @param $uploadedFile
     * @return File
     */
    public function storePhysicalFile($uploadedFile): File
    {
        $this->storeFile($file = $this->findOrCreateFile($uploadedFile), $uploadedFile);

        return $file;
    }

    private function getDrive()
    {
        return config('filesystems.documents_default', 'documents');
    }

    /**
     * @param $hash
     * @param $uploadedFile
     * @return string
     */
    private function makeFileName($hash, $uploadedFile): string
    {
        $extension = is_array($uploadedFile) ? $uploadedFile['extension'] : $uploadedFile->getClientOriginalExtension();
        return $hash . '.' . Str::lower($extension);
    }

    /**
     * @param $hash
     * @param $uploadedFile
     * @return string
     */
    private function makePath($hash, $uploadedFile): string
    {
        $deep = $this->makeDirectory($hash);

        $filename = $this->makeFileName($hash, $uploadedFile);

        return "{$deep}{$filename}";
    }
}
