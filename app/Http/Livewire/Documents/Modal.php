<?php

namespace App\Http\Livewire\Documents;

use App\Data\Repositories\DocumentTypes;
use App\Data\Repositories\States;
use App\Http\Livewire\BaseForm;
use Livewire\Component;

class Modal extends BaseForm
{



    public $person_id;
    public $document_type_id;
    public $number;
    public $state_id;

    public function render()
    {
        return view('livewire.documents.modal')->with($this->getViewVariables());
    }

    public function mount(){

    }

    public function formVariables()
    {
        return ['documentTypes' => app(DocumentTypes::class)->all(),
            'states' => app(States::class)->all()];
    }


    public function store(){
        dd('oi');

        $this->cleanModal();
    }

    public function cleanModal(){
        $this->person_id = null;
        $this->document_type_id = null;
        $this->number = null;
        $this->state_id = null;
    }


}
