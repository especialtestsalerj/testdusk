<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Traits\Swallable;
use Livewire\Component;
use Livewire\WithPagination;

abstract class BaseForm extends Component
{
    use WithPagination, Swallable;

    public $focus;
    protected $paginationTheme = 'bootstrap';

    public $mode = 'create';

    public function select2SelectOption($name, $value)
    {
        $this->dispatchBrowserEvent('select2SelectOption', ['name' => $name, 'value' => $value]);
    }

    public function select2Reload($name)
    {
        $this->dispatchBrowserEvent('select2Reload', ['name' => $name]);
    }

    public function select2Destroy($name)
    {
        $this->dispatchBrowserEvent('select2Destroy', ['name' => $name]);
    }

    public function select2SetReadOnly($name, $value)
    {
        $this->dispatchBrowserEvent('select2SetReadOnly', ['name' => $name, 'value'=>$value]);
    }

    public function select2Disable($name)
    {
        $this->dispatchBrowserEvent('select2Disable', ['name' => $name]);
    }

    public function select2Enable($name)
    {
        $this->dispatchBrowserEvent('select2Enable', ['name' => $name]);
    }

    public function select2ReloadOptions($items, $name)
    {
        $this->dispatchBrowserEvent('select2ReloadOptions', ['data'=>$items,'name' => $name]);
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

    public function getDocumentMask()
    {
        $documentType = $this->document_type_id;

        switch ($documentType) {
            case 1:
                return '999.999.999-99';
            default:
                return '';
        }
    }
}
