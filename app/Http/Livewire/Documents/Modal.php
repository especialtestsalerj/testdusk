<?php

namespace App\Http\Livewire\Documents;

use App\Data\Repositories\DocumentTypes;
use App\Data\Repositories\States;
use App\Http\Livewire\BaseForm;
use Livewire\Component;
use App\Models\Document;
use App\Models\Person;

class Modal extends BaseForm
{
    public $person;
    public $document;
    public $document_type_id;
    public $number;
    public $state_id;

    protected $listeners = [
        'editDocument',
        'createDocument'
    ];

    public function render()
    {
       return view('livewire.documents.modal')->with($this->getViewVariables());
    }

    public function formVariables()
    {
        return ['documentTypes' => app(DocumentTypes::class)->all(),
            'states' => app(States::class)->all()];
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
        $this->person->documents()->firstOrCreate([
            'person_id' => $this->person->id,
            'document_type_id' => $this->document_type_id,
        ], [
            'number' =>  $this->number,
            'state_id' =>  $this->state_id,
            'created_by_id' => auth()->user()->id,
            'updated_by_id' => auth()->user()->id,
        ]);
    }

    public function storeEditedDocument()
    {
        $this->document->update([
            'number' => $this->number,
            'state_id' =>  $this->state_id,
            'updated_by_id' => auth()->user()->id,
        ]);
    }

    public function store()
    {
        if($this->document) {
            $this->storeEditedDocument();
        }
        
        if($this->person) {
            $this->storeNewDocument();
        }
     
        $this->cleanModal();
    }

    public function cleanModal()
    {
        $this->person = null;
        $this->document;
        $this->document_type_id = null;
        $this->number = null;
        $this->state_id = null;
    }

}
