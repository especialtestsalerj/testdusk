<?php

namespace App\Http\Livewire\Agendamento;

use App\Data\Repositories\DocumentTypes;
use App\Http\Livewire\Reservations\Form;

class FormTailwind extends Form
{

    public function render()
    {

        $this->documentTypes = app(DocumentTypes::class)->allActive();
        $this->loadCountryBr();
        $this->loadDefaultLocation();



        return view('livewire.agendamento.form-tailwind')->with($this->getViewVariables());
    }

    public function loadDates()
    {
//        dump('datas');
        parent::loadDates();
//        $this->emit('load');
    }


}
