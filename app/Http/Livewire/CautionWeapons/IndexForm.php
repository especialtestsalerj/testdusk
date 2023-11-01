<?php

namespace App\Http\Livewire\CautionWeapons;

use App\Data\Repositories\CautionWeapons as CautionWeaponsRepository;
use App\Http\Livewire\BaseForm;
use App\Models\Caution;
use App\Models\CautionWeapon;
use App\Data\Repositories\Users as UsersRepository;
use App\Data\Repositories\WeaponTypes as WeaponTypesRepository;
use App\Data\Repositories\Cabinets as CabinetsRepository;
use App\Data\Repositories\Shelves as ShelvesRepository;
use App\Data\Repositories\Cautions as CautionsRepository;
use App\Rules\ValidPeriodOnCaution;

use Illuminate\Support\Facades\DB;
use function view;

class IndexForm extends BaseForm
{
    public CautionWeapon $cautionWeapon;
    public Caution $caution;
    public $selectedId;

    public $caution_id;
    public $caution_weapon_id;
    public $entranced_at;
    public $exited_at;
    public $weapon_type_id;
    public $weapon_description;
    public $weapon_number;
    public $register_number;
    public $cabinet_id;
    public $shelf_id;
    public $old_id;
    public $person_weapon;

    public $routineStatus;

    public $edit;
    public $modalMode;

    public $cautionWeapons;
    public $personWeapons = [];
    public $routine;
    public $disabled;
    public $readonly;
    public $redirect;

    public $hasPending;

    public function find()
    {
        $result =
            $this->person_weapon == null
                ? false
                : app(CautionWeaponsRepository::class)->findById($this->person_weapon);

        if ($result) {
            $this->entranced_at = $result?->entranced_at;
            $this->weapon_type_id = $result->weapon_type_id;
            $this->weapon_description = $result->weapon_description;
            $this->weapon_number = $result->weapon_number;
            $this->register_number = $result->register_number;
            $this->old_id = $result->old_id;
        } else {
            $this->entranced_at = null;
            $this->exited_at = null;
            $this->weapon_type_id = null;
            $this->weapon_description = null;
            $this->weapon_number = null;
            $this->register_number = null;
            $this->old_id = null;
        }
    }

    public function clearWeapon()
    {
        $this->selectedId = null;

        $this->person_weapon = null;
        $this->caution_weapon_id = null;
        $this->entranced_at = null;
        $this->exited_at = null;
        $this->weapon_type_id = null;
        $this->weapon_description = null;
        $this->weapon_number = null;
        $this->register_number = null;
        $this->cabinet_id = null;
        $this->shelf_id = null;
        $this->old_id = null;

        $this->readonly = false;

        $this->resetErrorBag();
    }

    public function prepareForCreate()
    {
        $this->modalMode = 'create';

        $this->clearWeapon();

        $this->entranced_at = $this->caution->started_at->format('Y-m-d H:i');

        $this->dispatchBrowserEvent('show-modal', ['target' => 'weapon-modal']);
    }

    public function prepareForUpdate($id, $readonly = false)
    {
        $this->selectedId = $id;
        $cautionWeapon = CautionWeapon::find($id);

        $this->modalMode = $readonly ? 'detail' : 'update';
        $this->readonly = $readonly;

        $this->caution_weapon_id = $id;
        $this->entranced_at = $cautionWeapon?->entranced_at?->format('Y-m-d H:i');
        $this->exited_at = $cautionWeapon?->exited_at?->format('Y-m-d H:i');
        $this->weapon_type_id = $cautionWeapon?->weapon_type_id;
        $this->weapon_description = $cautionWeapon?->weapon_description;
        $this->weapon_number = $cautionWeapon?->weapon_number;
        $this->register_number = $cautionWeapon?->register_number;
        $this->cabinet_id = $cautionWeapon?->cabinet_id;
        $this->shelf_id = $cautionWeapon?->shelf_id;
        $this->old_id = $cautionWeapon?->old_id;

        $this->dispatchBrowserEvent('show-modal', ['target' => 'weapon-modal']);
    }

    public function prepareForDelete($id)
    {
        $this->selectedId = $id;
        $cautionWeapon = CautionWeapon::find($id);

        $this->modalMode = 'delete';
        $this->readonly = true;

        $this->caution_weapon_id = $id;
        $this->entranced_at = $cautionWeapon?->entranced_at?->format('Y-m-d H:i');
        $this->exited_at = $cautionWeapon?->exited_at?->format('Y-m-d H:i');
        $this->weapon_type_id = $cautionWeapon?->weapon_type_id;
        $this->weapon_description = $cautionWeapon?->weapon_description;
        $this->weapon_number = $cautionWeapon?->weapon_number;
        $this->register_number = $cautionWeapon?->register_number;
        $this->cabinet_id = $cautionWeapon?->cabinet_id;
        $this->shelf_id = $cautionWeapon?->shelf_id;
        $this->old_id = $cautionWeapon?->old_id;

        $this->dispatchBrowserEvent('show-modal', ['target' => 'weapon-modal']);
    }

    public function store()
    {
        $validatedData = $this->validate(
            [
                'entranced_at' => [
                    'required',
                    new ValidPeriodOnCaution(
                        $this->caution_id,
                        $this->entranced_at,
                        'A Data da Entrada deve ser posterior à abertura da cautela.'
                    ),
                ],
                'exited_at' => [
                    'nullable',
                    new ValidPeriodOnCaution(
                        $this->caution_id,
                        $this->exited_at,
                        'A Data da Saída deve ser posterior à abertura da cautela.'
                    ),
                    'after_or_equal:entranced_at',
                ],
                'weapon_type_id' => 'required',
                'weapon_description' => 'required',
                'weapon_number' => 'required',
                'cabinet_id' => 'required',
                'shelf_id' => 'required',
            ],
            [
                'entranced_at.required' => 'Entrada: preencha o campo corretamente.',
                'exited_at.after_or_equal' =>
                    'A Data da Saída deve ser posterior à entrada da arma.',
                'weapon_type_id.required' => 'Tipo de Arma: preencha o campo corretamente.',
                'weapon_description.required' =>
                    'Descrição da Arma: preencha o campo corretamente.',
                'weapon_number.required' => 'Numeração da Arma: preencha o campo corretamente.',
                'cabinet_id.required' => 'Armário: preencha o campo corretamente.',
                'shelf_id.required' => 'Box: preencha o campo corretamente.',
            ]
        );

        $values = ['caution_id' => $this->caution_id];
        $values = array_merge($values, ['redirect' => $this->redirect]);
        $values = array_merge($values, ['caution_weapon_id' => $this->caution_weapon_id]);
        $values = array_merge($values, ['entranced_at' => $this->entranced_at]);
        $values = array_merge($values, [
            'exited_at' => $this?->exited_at == '' ? null : $this?->exited_at,
        ]);
        $values = array_merge($values, ['weapon_type_id' => $this->weapon_type_id]);
        $values = array_merge($values, [
            'weapon_description' => convert_case($this->weapon_description, MB_CASE_UPPER),
        ]);
        $values = array_merge($values, [
            'weapon_number' => convert_case($this->weapon_number, MB_CASE_UPPER),
        ]);
        $values = array_merge($values, [
            'register_number' => convert_case($this->register_number, MB_CASE_UPPER),
        ]);
        $values = array_merge($values, ['cabinet_id' => $this->cabinet_id]);
        $values = array_merge($values, ['shelf_id' => $this->shelf_id]);

        if ($this->selectedId) {
            DB::transaction(function () use ($values) {
                $currentCautionWeapon = app(CautionWeaponsRepository::class)->findById(
                    $this->selectedId
                );

                //syncronizing weapons
                if (isset($this->old_id)) {
                    $cautionWeapon = app(CautionWeaponsRepository::class)->findById($this->old_id);

                    $array = [];
                    $array = array_add(
                        $array,
                        'exited_at',
                        $this?->exited_at == '' ? null : $this?->exited_at
                    );
                    $array = array_add($array, 'weapon_type_id', $this->weapon_type_id);
                    $array = array_add($array, 'weapon_description', $this->weapon_description);
                    $array = array_add($array, 'weapon_number', $this->weapon_number);
                    $array = array_add($array, 'register_number', $this->register_number);
                    $array = array_add($array, 'cabinet_id', $this->cabinet_id);
                    $array = array_add($array, 'shelf_id', $this->shelf_id);

                    app(CautionWeaponsRepository::class)->update($this->old_id, $array);

                    $cautionWeapons = app(CautionWeaponsRepository::class)
                        ->findByOldId($this->old_id)
                        ->get();

                    if (isset($cautionWeapons)) {
                        foreach ($cautionWeapons as $cautionWeapon) {
                            if (
                                $cautionWeapon->id != $this->selectedId &&
                                isset($cautionWeapon?->old_id)
                            ) {
                                $array = [];
                                $array = array_add(
                                    $array,
                                    'exited_at',
                                    $this?->exited_at == '' ? null : $this?->exited_at
                                );
                                $array = array_add($array, 'weapon_type_id', $this->weapon_type_id);
                                $array = array_add(
                                    $array,
                                    'weapon_description',
                                    $this->weapon_description
                                );
                                $array = array_add($array, 'weapon_number', $this->weapon_number);
                                $array = array_add(
                                    $array,
                                    'register_number',
                                    $this->register_number
                                );
                                $array = array_add($array, 'cabinet_id', $this->cabinet_id);
                                $array = array_add($array, 'shelf_id', $this->shelf_id);

                                app(CautionWeaponsRepository::class)->update(
                                    $cautionWeapon->id,
                                    $array
                                );
                            }
                        }
                    }
                }

                $row = CautionWeapon::find($this->selectedId);
                $row->fill($values);
                $row->save();
            });
        } else {
            CautionWeapon::create($values);
        }

        $this->clearWeapon();
        $this->cautionWeapons = CautionWeapon::where('caution_id', $this->caution_id)->get();
        $this->dispatchBrowserEvent('hide-modal', ['target' => 'weapon-modal']);
        $this->emit('updateCautionWeaponList');
    }

    public function delete()
    {
        if ($this->selectedId) {
            CautionWeapon::find($this->selectedId)->delete();
        }

        $this->cautionWeapons = CautionWeapon::where('caution_id', $this->caution_id)->get();
        $this->dispatchBrowserEvent('hide-modal', ['target' => 'weapon-modal']);
        $this->emit('updateCautionWeaponList');
    }

    public function fillModel()
    {
        $this->entranced_at = is_null(old('entranced_at'))
            ? $this->cautionWeapon?->entranced_at?->format('Y-m-d H:i') ?? ''
            : old('entranced_at');

        $this->exited_at = is_null(old('exited_at'))
            ? $this->cautionWeapon?->exited_at?->format('Y-m-d H:i') ?? ''
            : old('exited_at');

        $this->weapon_type_id = is_null(old('weapon_type_id'))
            ? $this->cautionWeapon->weapon_type_id ?? ''
            : old('weapon_type_id');

        $this->weapon_description = is_null(old('weapon_description'))
            ? $this->cautionWeapon->weapon_description ?? ''
            : old('weapon_description');

        $this->weapon_number = is_null(old('weapon_number'))
            ? $this->cautionWeapon->weapon_number ?? ''
            : old('weapon_number');

        $this->register_number = is_null(old('register_number'))
            ? $this->cautionWeapon->register_number ?? ''
            : old('register_number');

        $this->cabinet_id = is_null(old('cabinet_id'))
            ? $this->cautionWeapon->cabinet_id ?? ''
            : old('cabinet_id');

        $this->shelf_id = is_null(old('shelf_id'))
            ? $this->cautionWeapon->shelf_id ?? ''
            : old('shelf_id');

        $this->old_id = is_null(old('old_id')) ? $this->cautionWeapon->old_id ?? '' : old('old_id');
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
        $this->cautionWeapons = CautionWeapon::where('caution_id', $this->caution_id)
            ->orderBy('id', 'asc')
            ->get();

        $this->caution = app(CautionsRepository::class)->findById($this->caution_id);

        if ($this->mode == 'create') {
            $this->cautionWeapon = new CautionWeapon();

            $this->personWeapons = CautionWeapon::select(
                'caution_weapons.id',
                'caution_weapons.entranced_at',
                'caution_weapons.exited_at',
                'caution_weapons.weapon_type_id',
                'caution_weapons.weapon_description',
                'caution_weapons.weapon_number',
                'caution_weapons.register_number'
            )
                ->join('cautions', 'caution_weapons.caution_id', '=', 'cautions.id')
                ->join('visitors', 'cautions.visitor_id', '=', 'visitors.id')
                ->where('visitors.person_id', $this->caution->visitor->person->id)
                ->where('cautions.id', '<>', $this->caution->id)
                ->get();
        }

        $this->fillModel();
    }

    public function render()
    {
        return view('livewire.caution-weapons.form')->with($this->getViewVariables());
    }
}
