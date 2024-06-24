<?php

namespace App\Http\Livewire\SectorUsers;

use App\Data\Repositories\Users;
use App\Http\Livewire\BaseForm;
use App\Models\Sector;
use Livewire\Component;

class Modal extends BaseForm
{
    protected $listeners = ['associateUserInSector'];
    public $users;

    public $sector;

    public $user_id;
    public function render()
    {

        $this->users = app(Users::class)->allWithAbility(make_ability_name_with_current_building('reservation:show'));
        return view('livewire.sector-users.modal');
    }

    public function associateUserInSector(Sector $sector)
    {
        $this->sector = $sector;
        $this->users = $this->users->diff($this->sector->users);

    }

    public function cleanModal()
    {
        $this->reset();
        $this->resetErrorBag();
    }

    public function store()
    {
        $this->sector->users()->attach([$this->user_id]);
        $this->dispatchBrowserEvent('hide-modal', ['target' => 'sector-user-modal']);
        $this->cleanModal();
        $this->emit('associated-sector-user', $this->sector);
        $this->swallSuccess('Novo Usuário Adicionado com Sucesso.');
    }
}
