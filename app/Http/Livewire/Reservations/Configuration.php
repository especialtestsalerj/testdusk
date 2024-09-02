<?php

namespace App\Http\Livewire\Reservations;

use App\Data\Repositories\Sectors;
use App\Http\Livewire\BaseForm;
use App\Models\BlockedDate;
use App\Models\Capacity;
use App\Models\Sector;
use App\Models\User;
use Livewire\Component;

class Configuration extends BaseForm
{

    public Sector $sector;

    public $sector_id;

    public $selectedCapacity_id;

    public $selectedBlockedDate_id;

    public $selecteduser_id;

    public $capacities =[];

    public $blockedDates=[];

    public $max_date;
    public $is_visitable;
    public $nickname;
    public $required_motivation;
    public $display_remaining_vacancies;

    protected $listeners =[
        'created-capacity' =>'loadCapacities',
        'associated-sector-user' =>'loadCapacities',
        'created-blocked-date' =>'loadBlockedDates',
        'confirm-delete-capacity' => 'deleteCapacity',
        'confirm-delete-blocked-date' => 'deleteBlockedDate',
        'confirm-desassociate-user' => 'desassociateUser',
    ];


    public function mount()
    {
        if (!auth()->user()->isAn('Administrador') && auth()->user()->sectors->count() === 1) {

            $this->sector_id = auth()->user()->sectors->first()->id;
            $this->sector = auth()->user()->sectors->first();
            $this->loadCapacities();
            $this->loadBlockedDates();
            $this->fillForm();
        }
   }

    public function render()
    {
        return view('livewire.reservations.configuration')->with($this->getViewVariables());
    }

    protected function getComponentVariables()
    {

        return ['sectors' =>app(Sectors::class)->allForUser()];
    }


    public function loadCapacities()
    {


        if(!empty($this->sector_id)) {
            $this->capacities = Capacity::where('sector_id',$this->sector_id)->get();
            $this->sector = Sector::where('id',$this->sector_id)->first();


        }else{
            $this->capacities = [];
        }
    }


    public function updatedSectorId($newValue)
    {
        if (is_null($newValue)) {
            return;

        }

        $this->loadCapacities();
        $this->loadBlockedDates();
        $this->fillForm();

    }

    public function loadBlockedDates()
    {
        if(!empty($this->sector_id)) {
            $this->blockedDates = BlockedDate::where('sector_id',$this->sector_id)->orderBy('date')->get();

        }else{
            $this->blockedDates = [];
        }
    }

    public function createCapacity($sector)
    {

        $this->emit('createCapacity', $sector);
    }

    public function createBlockedDate($sector)
    {
        $this->emit('createBlockedDate',$sector);
    }

    public function associateUserInSector($sector)
    {
        $this->emit('associateUserInSector',$sector);
    }

    public function editCapacity($capacity)
    {

        $this->emit('editCapacity', $capacity);
    }

    public function prepareForDeleteCapacity($capacity_id)
    {
        $this->selectedCapacity_id = $capacity_id;
        $capacity = Capacity::find($capacity_id);
        $this->emitSwall(
            'Deseja realmente remover o horário de ' . $capacity->hour . '?',
            'A ação não poderá ser desfeita.',
            'confirm-delete-capacity',
            'delete'
        );
    }

    public function prepareForDeleteBlockedDate($blockedDate_id)
    {
        $this->selectedBlockedDate_id = $blockedDate_id;
        $blockedDate = BlockedDate::find($blockedDate_id);
        $this->emitSwall('Deseja realmente remover a Data?',
        'A ação não poderá ser desfeita.',
        'confirm-delete-blocked-date',
        'delete');
    }

    public function deleteCapacity()
    {
        $capacity = Capacity::find($this->selectedCapacity_id);
        $capacity->delete();
        $this->loadCapacities();
    }

    public function deleteBlockedDate()
    {
        $blockedDate = BlockedDate::find($this->selectedBlockedDate_id);
        $blockedDate->delete();
        $this->loadBlockedDates();
    }

    public function prepareForDesassociateUser($user_id)
    {
        $this->selecteduser_id = $user_id;
        $user = User::find($user_id);
        $this->emitSwall('Deseja realmente Remover '. $user->name .' da agenda?',
            'A ação não poderá ser desfeita.',
            'confirm-desassociate-user',
            'delete');
    }

    public function desassociateUser()
    {
        $this->sector->users()->detach([$this->selecteduser_id]);
        $this->loadCapacities();
    }

    private function fillForm()
    {
        $this->max_date = $this->sector->max_date;
        $this->is_visitable = $this->sector->is_visitable;
        $this->nickname = $this->sector->nickname;
        $this->required_motivation = $this->sector->required_motivation;
        $this->display_remaining_vacancies = $this->sector->display_remaining_vacancies;


    }

    public function save()
    {



         $this->sector->max_date = $this->max_date;
         $this->sector->is_visitable = $this->is_visitable;
         $this->sector->nickname = $this->nickname;
         $this->sector->required_motivation = $this->required_motivation;
         $this->sector->display_remaining_vacancies = $this->display_remaining_vacancies;
         $this->sector->save();

        return redirect(request()->header('Referer'))->with(['message'=>'Configurações atualizadas com sucesso']);
    }


}
