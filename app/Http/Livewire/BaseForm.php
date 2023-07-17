<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

abstract class BaseForm extends Component
{
    use WithPagination;

    public $focus;
    protected $paginationTheme = 'bootstrap';

    public $mode = 'create';

    public function select2SelectOption($name, $value)
    {
        $this->dispatchBrowserEvent('select2SelectOption', ['name' => $name, 'value' => $value]);
    }
    protected function focus($ref)
    {
        $this->dispatchBrowserEvent('focus-field', ['field' => $ref]);
    }

    protected function formVariables()
    {
        return [];
    }

    protected function getComponentVariables()
    {
        return [];
    }
    protected function getViewVariables()
    {
        return $this->formVariables() + $this->getComponentVariables();
    }
}
