<?php

namespace App\Http\Livewire\CautionWeapons;

use App\Http\Livewire\BaseForm;
use App\Models\CautionWeapon;
use App\Data\Repositories\Users as UsersRepository;
use App\Data\Repositories\WeaponTypes as WeaponTypesRepository;
use App\Data\Repositories\Cabinets as CabinetsRepository;
use App\Data\Repositories\Shelves as ShelvesRepository;

use Carbon\Carbon;
use function view;

class CreateForm extends BaseForm
{
    public CautionWeapon $cautionWeapon;
    public $selectedId;

    public $caution_id;
    public $caution_weapon_id;
    public $weapon_type_id;
    public $description;
    public $weapon_number;
    public $cabinet_id;
    public $shelf_id;

    public $entranced_at;
    public $routineStatus;

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
        $this->description = mb_strtoupper($cautionWeapon?->description);
        $this->weapon_number = mb_strtoupper($cautionWeapon?->weapon_number);
        $this->cabinet_id = $cautionWeapon?->cabinet_id;
        $this->shelf_id = $cautionWeapon?->shelf_id;

        $this->dispatchBrowserEvent('show-modal', ['target' => 'weaponModal']);
    }

    public function store()
    {
        $values = ['caution_id' => $this->caution_id];
        $values = array_merge($values, ['entranced_at' => Carbon::now()]);
        $values = array_merge($values, ['exited_at' => Carbon::now()]);
        $values = array_merge($values, ['caution_weapon_id' => $this->caution_weapon_id]);
        $values = array_merge($values, ['weapon_type_id' => $this->weapon_type_id]);
        $values = array_merge($values, ['weapon_description' => mb_strtoupper($this->description)]);
        $values = array_merge($values, ['weapon_number' => mb_strtoupper($this->weapon_number)]);
        $values = array_merge($values, ['cabinet_id' => $this->cabinet_id]);
        $values = array_merge($values, ['shelf_id' => $this->shelf_id]);

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
        //$validatedData['entranced_at'] = null; //todo: definir regras para datas
        if ($this->selectedId) {
            $row = CautionWeapon::find($this->selectedId);
            //$row->fill($validatedData);
            $row->save();
        } else {
            //CautionWeapon::create($validatedData);
            CautionWeapon::create($values);
        }

        $this->clearWeapon();
        $this->cautionWeapon->refresh();
        $this->dispatchBrowserEvent('hide-modal', ['target' => 'weapon-modal']);
        return redirect()->to('/cautions/' . $this->caution_id);
    }

    public function fillModel()
    {
        $this->entranced_at = is_null(old('entranced_at'))
            ? $this->cautionWeapon->entranced_at ?? ''
            : old('entranced_at');

        $this->weapon_type_id = is_null(old('weapon_type_id'))
            ? $this->cautionWeapon->weapon_type_id ?? ''
            : old('weapon_type_id');

        //$this->routineStatus = $this->cautionWeapon->routineStatus;
    }

    protected function getComponentVariables()
    {
        return [
            'users' => app(UsersRepository::class)->all(),
            'weaponTypes' => app(WeaponTypesRepository::class)->all(),
            'cabinets' => app(CabinetsRepository::class)->all(),
            'shelves' => app(ShelvesRepository::class)->all(),
        ];
    }

    public function mount()
    {
        if ($this->mode == 'create') {
            $this->cautionWeapon = new CautionWeapon();
        } else {
            $this->cautionWeapon = CautionWeapon::find($this->caution_weapon_id);
        }

        $this->fillModel();
    }

    public function render()
    {
        return view('livewire.caution-weapons.form')->with($this->getViewVariables());
    }
}
