<?php

namespace App\Rules;

use App\Models\Document;
use App\Models\DocumentType;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class CpfAvailableOnVisit implements Rule
{
    public $id;
    public $routine_id;
    public $document_number;

    public $document_type_id;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($id, $routine_id, $document_number, $document_type_id)
    {
        $this->id = $id;
        $this->routine_id = $routine_id;
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
        $documentType = DocumentType::where('id', '=', $this->document_type_id)->first();

        if ($documentType?->name == 'CPF') {
            $query = DB::table('visitors')
                ->join('people', 'visitors.person_id', '=', 'people.id')
                ->join('documents', 'visitors.person_id', '=', 'documents.person_id')
                ->where('documents.number', $this->document_number)
                ->whereNull('visitors.exited_at');

            if (!is_null($this->id)) {
                $query->where('visitors.id', '<>', $this->id);
            }

            return $query->doesntExist();
        } else {
            return true;
        }
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
}
