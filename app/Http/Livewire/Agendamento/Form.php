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
            'state_id' => 'required|exists:states,id',
            'city_id' => 'required|exists:cities,id',
            'other_city' => 'nullable|string|max:255',
            'responsible_email' => 'required|email|max:255',
            'confirm_email' => 'required|same:responsible_email',
            'contact' => 'required|string|max:20',
            'motive' => 'required_if:sector.required_motivation,true',
            'has_disability' => 'required|boolean',
            'disabilities' => 'nullable',
            'has_group' => 'required|boolean',
            'institution' => 'required_if:has_group,true',
            'inputs.*.cpf' => ['required_if:has_group,true', new ValidCPF()],
            'inputs.*.name' => 'required_if:has_group,true|string|max:255',
            'inputs.*.documentType' => 'required_if:has_group,true',
        ];
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
        $this->inputs[] = ['cpf' => '', 'name' => '', 'documentType' => ''];
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
            'document_number' => $this->document_number,
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

}
