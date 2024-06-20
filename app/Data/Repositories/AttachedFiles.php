<?php
namespace App\Data\Repositories;

use App\Data\Repositories\Files as FilesRepository;
use App\Models\AttachedFile as AttachedFileModel;
use Illuminate\Http\UploadedFile;

class AttachedFiles extends Repository
{
    protected $model = AttachedFileModel::class;

    public function store($fileable, UploadedFile $file, $originalName, $checkDuplicate = true)
    {
        $physicalFile = app(FilesRepository::class)->storePhysicalFile($file);

        if ($checkDuplicate && $this->documentWasAlreadyUploaded($physicalFile)) {
            return;
        }

        app(FilesRepository::class)->createAttachment($fileable, $physicalFile, $originalName);
    }

    private function documentWasAlreadyUploaded($physicalFile): bool
    {
        return AttachedFileModel::where('file_id', $physicalFile->id)->exists();
    }
}
