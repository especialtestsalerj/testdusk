<?php

namespace App\Rules;

use App\Models\Document;
use App\Models\DocumentType;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Data\Repositories\DocumentTypes;

class CpfAvailableOnVisit implements Rule
{
    public $id;
    public $document_number;

    public $document_type_id;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($id, $document_number, $document_type_id)
    {
        $this->id = $id;
        $this->document_number = $document_number;

        $this->document_type_id = $document_type_id;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $documentType = app(DocumentTypes::class)->getByName('CPF');

//        if ($this->document_type_id == $documentType->id) {
            $query = DB::table('visitors')
                ->join('documents', 'visitors.document_id', '=', 'documents.id')
                ->where('documents.number', $this->document_number)
                ->where('documents.document_type_id', $this->document_type_id)
                ->whereNull('visitors.exited_at');

            if ($this->isUpdating()) {
                $query->where('visitors.id', '<>', $this->id);
            }

            return $query->doesntExist();
//        } else {
//            //TODO: Uma mesma pessoa pode entrar com dois documentos diferentes sem ter que dar baixa na visita anterior
//            return true;
//        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'CPF (Visitante): possui visita em aberto.';
    }

    /**
     * @return bool
     */
    protected function isUpdating(): bool
    {
        return !is_null($this->id);
    }
}
