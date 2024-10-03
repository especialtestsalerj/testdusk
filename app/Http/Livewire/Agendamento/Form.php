<?php

namespace App\Http\Livewire\Agendamento;

use App\Data\Repositories\Reservations as ReservationRepository;
use App\Http\Livewire\Reservations\Form as FormBase;
use App\Http\Livewire\Traits\Maskable;
use App\Models\Sector as SectorModel;
use App\Rules\ValidCPF;
use Carbon\Carbon;
use Illuminate\Validation\Rule;

class Form extends FormBase
{
    use Maskable;

    public $inputs = [];

    protected $validationAttributes = [
        'contact' => 'Telefone (DD) + Número',
    ];

    protected $messages = [
        'required_if' => ':attribute: preencha o campo corretamente',
    ];

    public function rules()
    {
        return [
            'sector_id' => 'required|exists:sectors,id',
            'birthdate' => 'required',
            'reservation_date' => 'required|date_format:d/m/Y|after_or_equal:today',
            'capacity_id' => 'required|exists:capacities,id',
            'document_type_id' => 'required|exists:document_types,id',
            'document_number' => ['bail', 'required', Rule::when($this->document_type_id == config('app.document_type_cpf'), [new ValidCPF()])],
            'full_name' => 'required|string|max:255',
            'social_name' => 'nullable|string|max:255',
            'country_id' => 'required|exists:countries,id',
            'state_id' => 'required_if:country_id,' . config('app.country_br'),
            'city_id' => 'required_if:country_id,' . config('app.country_br'),
            'other_city' => 'required_unless:country_id,' . config('app.country_br'),
            'responsible_email' => 'required|email|max:255',
            'confirm_email' => 'required|same:responsible_email',
            'contact' => 'required|string|max:20',
            'motive' => 'required_if:sector.required_motivation,true',
            'has_disability' => 'required|boolean',
            'disabilities' => 'required_if:has_disability,true|array',
            'has_group' => 'required|boolean',
            'institution' => 'required_if:has_group,true',
            'inputs.*.document' => [
                'required_if:has_group,true',
                function ($attribute, $value, $fail) {
                    // Acessando o documentType relacionado ao campo document específico
                    $inputs = request()->input('serverMemo.data.inputs');

                    // Extraindo o índice do campo atual
                    preg_match('/inputs\.(\d+)\.document/', $attribute, $matches);
                    $index = $matches[1]; // O índice correspondente ao document atual

                    // Verificando o documentType desse item específico
                    $documentType = $inputs[$index]['documentType'] ?? null;

                    // Valida o CPF apenas se o documentType for igual a CPF (configurado)
                    if ($documentType == config('app.document_type_cpf') && !validate_cpf($value)) {
                        $fail('O CPF informado é inválido.');
                    }
                },
            ],
            'inputs.*.name' => 'required_if:has_group,true|string|max:255',
            'inputs.*.documentType' => 'required_if:has_group,true',
        ];
    }

    public function updatedHasDisability()
    {
        $this->reset('disabilities');
        $this->resetErrorBag(['disabilities']);
    }

    public function updatedHasGroup()
    {
        $this->reset('inputs', 'institution');
        $this->resetErrorBag(['inputs.*.document', 'inputs.*.name', 'inputs.*.documentType', 'institution']);

        if ($this->has_group == true) {
            $this->addInput();
        }
    }

    public function render()
    {
        $this->loadCountryBr();
        $this->loadDefaultLocation();
        $this->applyMasks();

        return view('livewire.agendamento.form')->with($this->getViewVariables());
    }

    public function addInput()
    {
        $this->inputs[] = ['document' => '', 'name' => '', 'documentType' => ''];
    }

    public function removeInput($index)
    {
        unset($this->inputs[$index]);

        $this->inputs = array_values($this->inputs); // Reindexa o array
    }


    public function save()
    {
        $this->validate();

        $data = $this->prepareReservationData();

        $reservation = app(ReservationRepository::class)->create($data);

        return redirect()->route('agendamento.detail', ['uuid' => $reservation->uuid]);
    }

    private function prepareReservationData()
    {
        return array_merge(
            $this->getBasicReservationData(),
            [
                'building_id' => $this->getBuildingId(),
                'quantity' => $this->calculateQuantity(),
                'guests' => $this->inputs,
                'person' => $this->getPersonData(),
                'reservation_type_id' => 1,
                'code' => generate_code(),
                'reservation_status_id' => 1,
            ]
        );
    }

    private function getBasicReservationData()
    {
        return [
            'sector_id' => $this->sector_id,
            'reservation_date' => $this->formatDate($this->reservation_date),
            'full_name' => $this->full_name,
            'social_name' => $this->social_name,
            'document_type_id' => $this->document_type_id,
            'document_number' => $this->document_number,
            'country_id' => $this->country_id,
            'state_id' => $this->state_id,
            'city_id' => $this->city_id,
            'other_city' => $this->other_city,
            'responsible_email' => $this->responsible_email,
            'mobile' => $this->contact,
            'motive' => $this->motive,
            'has_disability' => $this->has_disability,
            'disabilities' => $this->disabilities,
            'capacity_id' => $this->capacity_id,
        ];
    }

    private function formatDate(string $date): string
    {
        return Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d');
    }

    private function getBuildingId(): int
    {
        return SectorModel::withoutGlobalScopes()->findOrFail($this->sector_id)->building_id;
    }

    private function calculateQuantity(): int
    {
        return count($this->inputs) + 1;
    }

    private function getPersonData(): array
    {
        return [
            'full_name' => $this->full_name,
            'social_name' => $this->social_name,
            'document_type_id' => $this->document_type_id,
            'document_number' => remove_punctuation($this->document_number),
            'country_id' => $this->country_id,
            'state_id' => $this->state_id,
            'city_id' => $this->city_id,
            'other_city' => $this->other_city,
            'email' => $this->responsible_email,
            'mobile' => $this->contact,
            'has_disability' => $this->has_disability,
            'disabilities' => $this->disabilities,
            'birthdate' => $this->birthdate,
        ];
    }

    public function updated($propertyName)
    {
        if (str_contains($propertyName, 'inputs.') && str_contains($propertyName, '.documentType')) {
            // Extrai o índice da propriedade
            preg_match('/inputs\.(\d+)\.documentType/', $propertyName, $matches);
            $index = $matches[1];

            // Obtém o documentType atual
            $documentType = $this->inputs[$index]['documentType'];

            $mask = '';
            if ($documentType == '1') {
                $mask = '999.999.999-99'; // Máscara para CPF
            }

            // Dispara um evento para o navegador
            $this->dispatchBrowserEvent('change-mask', [
                'ref' => 'document_' . $index,
                'mask' => $mask,
            ]);
        }
    }

}
