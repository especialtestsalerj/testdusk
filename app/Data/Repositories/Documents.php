<?php

namespace App\Data\Repositories;

use App\Models\Document;

class Documents extends Repository
{
    /**
     * @var string
     */
    protected $model = Document::class;

    public function findByDocumentNumber($document_type_id, $document_number, $state_document_id)
    {
        return $this->model
            ::where('document_type_id', $document_type_id)
            ->where('number', '=', $document_number)
            ->where(function ($query) use ($document_type_id, $state_document_id) {
                if ($document_type_id == config('app.document_type_rg')) {
                    $query->where('state_id', $state_document_id);
                } else {
                    $query->whereNull('state_id');
                }
            })
            ->first();
    }
}
