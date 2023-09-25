<?php

namespace App\Http\Livewire\Documents;

use App\Data\Repositories\DocumentTypes;
use App\Data\Repositories\States;
use App\Http\Livewire\BaseForm;
use App\Http\Livewire\Traits\Maskable;
use App\Models\Document;
use App\Models\Person;

class Modal extends BaseForm
{
    use Maskable;

    public $person;
    public $document;
    public $document_type_id;
    public $number;
    public $state_id;

    protected $listeners = ['editDocument', 'createDocument'];

    public $rules = [
        'document_type_id' => 'required',
        'number' => 'required',
        'state_id' => 'required_if:document_type_id,2',
    ];

    protected $messages = [
        'required' => ':attribute: preencha o campo corretamente.',
        'required_if' => ':attribute: preencha o campo corretamente.',
    ];

    protected $validationAttributes = [
        'document_type_id' => 'Tipo de Documento',
        'number' => 'Número',
        'state_id' => 'Estado',
    ];

    public function render()
    {
        $this->applyMasks();
        return view('livewire.documents.modal')->with($this->getViewVariables());
    }

    public function formVariables()
    {
        return [
            'documentTypes' => app(DocumentTypes::class)->all(),
            'states' => app(States::class)->all(),
        ];
    }

    public function editDocument(Document $document)
    {
        $this->document = $document;
        $this->document_type_id = $document->document_type_id;
        $this->number = $document->number;
        $this->state_id = $document->state_id;
    }

    public function createDocument(Person $person)
    {
        $this->person = $person;
    }

    public function storeNewDocument()
    {
        $this->validate();

        $this->dispatchBrowserEvent('hide-modal', ['target' => 'document-modal']);

        if (intval($this->document_type_id) == app(DocumentTypes::class)->getCPF()->id) {
            $cpf = Document::where('person_id', $this->person->id)
                ->where('document_type_id', $this->document_type_id)
                ->first();

            if (!empty($cpf)) {
                $this->swallError('A pessoa já possui um CPF cadastrado');
                return;
            }
        }
        $this->person->documents()->create([
            'number' => convert_case(remove_punctuation($this->number), MB_CASE_UPPER),
            'document_type_id' => $this->document_type_id,
            'person_id' => $this->person->id,
            'state_id' => $this->state_id,
        ]);
    }

    public function storeEditedDocument()
    {
        $this->validate();

        $this->dispatchBrowserEvent('hide-modal', ['target' => 'document-modal']);

        $this->document->update([
            'number' => convert_case(remove_punctuation($this->number), MB_CASE_UPPER),
            'state_id' => $this->state_id,
        ]);
    }

    private function isValidCpf()
    {
        if (!validate_cpf($this->number)) {
            $this->swallError('CPF inválido');
            return false;
        }
        return true;
    }

    public function store()
    {
        if (intval($this->document_type_id) == app(DocumentTypes::class)->getCPF()->id) {
            if (!$this->isValidCpf()) {
                return;
            }
        }
        if ($this->document) {
            $this->storeEditedDocument();
            $this->emit('create-document', $this->document->person);
        }
        if ($this->person) {
            $this->storeNewDocument();
            $this->emit('create-document', $this->person);
        }

        $this->cleanModal();
    }

    public function cleanModal()
    {
        $this->reset();
        $this->resetErrorBag();
    }

    public function updatedDocumentTypeId()
    {
        $this->reset('number', 'state_id');
    }
}
