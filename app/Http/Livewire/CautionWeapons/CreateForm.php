<?php

namespace App\Http\Livewire\CautionWeapons;

use App\Http\Livewire\BaseForm;
use App\Models\CautionWeapon;
use App\Data\Repositories\Users as UsersRepository;
use function view;

class CreateForm extends BaseForm
{
    public CautionWeapon $cautionWeapon;
    public $selectedId;

    public $caution_weapon_id;
    public $weapon_type_id;
    public $description;
    public $weapon_number;
    public $cabinet_id;
    public $shelf_id;

    public $entranced_at;

    public function clearWeapon()
    {
        $this->selectedId = null;
        $this->resetErrorBag();
    }

    public function prepareForUpdate($id)
    {
        $this->selectedId = $id;
        $cautionWeapon = CautionWeapon::find($id);

        $this->caution_weapon_id = $cautionWeapon->caution_weapon_id;
        $this->weapon_type_id = $cautionWeapon?->weapon_type_id;
        $this->description = $cautionWeapon?->description;
        $this->weapon_number = $cautionWeapon?->weapon_number;
        $this->cabinet_id = $cautionWeapon?->cabinet_id;
        $this->shelf_id = $cautionWeapon?->shelf_id;

        $this->dispatchBrowserEvent('show-modal', ['target' => 'weaponModal']);
    }

    public function store()
    {
        /*$this->start_date = Carbon::createFromFormat('!m-Y', $this->start_date)
            ->startOfMonth()
            ->toDateString();
        if ($this->end_date) {
            $this->end_date = Carbon::createFromFormat('!m-Y', $this->end_date)
                ->endOfMonth()
                ->toDateString();
        }

        $validatedData = $this->withValidator(function (Validator $validator) {
            $validator->after(function ($validator) {
                if ($validator->failed()) {
                    $this->start_date = Carbon::create($this->start_date)->format('m-Y');
                    if ($this->end_date) {
                        $this->end_date = Carbon::create($this->end_date)->format('m-Y');
                    }
                }
            });
        })->validate([
            'cost_center_id' => 'required',
            'start_date' => [
                'required',
                'date',
                new EmptyPeriod(
                    $this->start_date,
                    $this->end_date,
                    $this->cost_center_id,
                    $this->selectedId
                ),
            ],
            'end_date' => $this->end_date ? 'date|after_or_equal:start_date' : '',
        ]);

        if ($validatedData['end_date'] == '') {
            $validatedData['end_date'] = null;
        } else {
            $validatedData['end_date'] = Carbon::create($validatedData['end_date'])->endOfDay();
        }
        $validatedData['limit'] = $this->limit;*/
        $validatedData['entranced_at'] = null; //todo: definir regras para datas
        if ($this->selectedId) {
            $row = CautionWeapon::find($this->selectedId);
            $row->fill($validatedData);
            $row->save();
        } else {
            CautionWeapon::create($validatedData);
        }

        $this->clearWeapon();
        $this->cautionWeapon->refresh();
        $this->dispatchBrowserEvent('hide-modal', ['target' => 'weaponModal']);
    }

    public function fillModel()
    {
        $this->entranced_at = is_null(old('entranced_at'))
            ? $this->cautionWeapon->entranced_at ?? ''
            : old('entranced_at');
    }

    protected function getComponentVariables()
    {
        return [];
    }

    public function mount()
    {
        $users = app(UsersRepository::class)->all('name');

        if ($this->mode == 'create') {
            $this->cautionWeapon = new CautionWeapon();
        }

        $this->fillModel();
    }

    public function render()
    {
        return view('livewire.caution-weapons.form')->with($this->getViewVariables());
    }
}
