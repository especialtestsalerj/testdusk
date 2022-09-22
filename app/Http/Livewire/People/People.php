<?php

namespace App\Http\Livewire\People;

use App\Data\Repositories\People as PeopleRepository;
use Livewire\Component;
use function app;
use function info;
use function view;

class People extends Component
{
    public $visitor;

    public $person_id;
    public $cpf;
    public $full_name;
    public $origin;

    public function searchCpf()
    {
        try {
            if ($result = app(PeopleRepository::class)->findByCpf($this->cpf)) {
                $this->person_id = $result['id'];
                $this->full_name = $result['full_name'];
                $this->origin = $result['origin'];

                $this->resetErrorBag('cpf');
            } else {
                $this->focus('cpf');
                $this->person_id = null;
                $this->full_name = null;
                $this->origin = null;

                $this->addError('cpf', 'CPF não encontrado');
            }
        } catch (\Exception $e) {
            $this->focus('cpf');
            info('Exception no CPF');
        }
    }

    protected function focus($ref)
    {
        $this->dispatchBrowserEvent('focus-field', ['field' => $ref]);
    }

    public function render()
    {
        return view('livewire.people.partials.person');
    }
}
