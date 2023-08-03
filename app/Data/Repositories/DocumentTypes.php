<?php

namespace App\Data\Repositories;

use App\Models\DocumentType;
use Illuminate\Support\Facades\Cache;

class DocumentTypes extends Repository
{
    /**
     * @var string
     */
    protected $model = DocumentType::class;


    public function getByName($name)
    {
        return Cache::remember('document_type:' . $name, now()->addHours(24), function () use ($name) {
            return DocumentType::where('name', $name)->first();
        });
    }

    public function getCPF()
    {
        return $this->getByName('CPF');
    }



}
