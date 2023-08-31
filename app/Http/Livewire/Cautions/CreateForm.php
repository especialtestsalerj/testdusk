<?php

namespace App\Http\Livewire\Cautions;

use App\Data\Repositories\CertificateTypes as CertificateTypesRepository;
use App\Data\Repositories\Routines as RoutinesRepository;
use App\Data\Repositories\Users as UsersRepository;
use App\Data\Repositories\Visitors as VisitorsRepository;
use App\Http\Livewire\BaseForm;
use App\Models\Caution;
use App\Models\Routine;
use App\Data\Repositories\Cautions as CautionsRepository;

class CreateForm extends BaseForm
{
    protected $repository = CautionsRepository::class;

    public Routine $routine;
    public $routine_id;

    public Caution $caution;
    public $caution_id;
    public $selectedId;

    public $started_at;
    public $concluded_at;
    public $visitor_id;
    public $destiny_sector_name;
    public $certificate_type_id;
    public $certificate_number;
    public $certificate_valid_until;
    public $duty_user_id;
    public $description;

    public $personCertificates = [];
    public $person_certificate;

    public $disabled;
    public $redirect;
    public $msg_visitor;

    public function clearCaution()
    {
        $this->selectedId = null;

        $this->started_at = null;
        $this->concluded_at = null;
        $this->visitor_id = null;
        $this->destiny_sector_name = null;
        $this->certificate_type_id = null;
        $this->certificate_number = null;
        $this->certificate_valid_until = null;
        $this->duty_user_id = null;
        $this->description = null;
        $this->person_certificate = null;

        $this->resetErrorBag();
    }

    public function loadVisitorInfo()
    {
        $this->msg_visitor = null;
        $this->destiny_sector_name = null;
        $this->personCertificates = [];
        $this->person_certificate = null;
        $this->certificate_type_id = null;
        $this->certificate_number = null;
        $this->certificate_valid_until = null;

        if (!empty($this->visitor_id)) {
            $visitor = app(VisitorsRepository::class)->findById($this->visitor_id);
            $this->destiny_sector_name = $visitor?->sector?->name;

            $this->loadCertificates($visitor);

            if ($visitor->hasOpenCaution($this->caution_id)) {
                if ($this->mode == 'create' || !$this->caution->hasPending()) {
                    $this->msg_visitor = 'Visitante possui cautela em aberto.';
                }
            }
        }
    }

    public function loadCertificates($visitor)
    {
        if ($this->mode == 'create') {
            $this->personCertificates = Caution::select(
                'cautions.certificate_type_id',
                'cautions.certificate_number',
                'cautions.certificate_valid_until'
            )
                ->join('visitors', 'cautions.visitor_id', '=', 'visitors.id')
                ->where('visitors.person_id', $visitor->person->id)
                ->distinct()
                ->get();
        }
    }

    public function loadPersonCertificateInfo()
    {
        $visitor = app(VisitorsRepository::class)->findById($this->visitor_id);

        if (!isset($visitor)) {
            $result = false;
        } else {
            $result =
                $this->person_certificate == null
                    ? false
                    : app(CautionsRepository::class)->findByCertificate(
                        $visitor->person->id,
                        $this->person_certificate
                    );
        }

        if ($result) {
            $this->certificate_type_id = $result?->certificate_type_id;
            $this->certificate_number = $result?->certificate_number;
            $this->certificate_valid_until = $result?->certificate_valid_until?->format('Y-m-d');
        } else {
            $this->certificate_type_id = null;
            $this->certificate_number = null;
            $this->certificate_valid_until = null;
        }

        $this->loadCertificates($visitor);
    }

    public function fillModel()
    {
        $this->caution_id = is_null(old('id')) ? $this->caution->id ?? null : old('id');

        $this->visitor_id = $this->started_at = is_null(old('started_at'))
            ? $this->caution?->started_at?->format('Y-m-d H:i') ?? now()->format('Y-m-d H:i')
            : old('started_at');

        $this->concluded_at = is_null(old('concluded_at'))
            ? $this->caution?->concluded_at?->format('Y-m-d H:i') ?? ''
            : old('concluded_at');

        $this->visitor_id = is_null(old('visitor_id'))
            ? $this?->caution->visitor_id
            : old('visitor_id');

        $this->loadVisitorInfo();

        $this->certificate_type_id = is_null(old('certificate_type_id'))
            ? $this?->caution->certificate_type_id
            : old('certificate_type_id');

        $this->certificate_number = is_null(old('certificate_number'))
            ? $this?->caution->certificate_number
            : old('certificate_number');

        $this->certificate_valid_until = is_null(old('certificate_valid_until'))
            ? $this?->caution->certificate_valid_until
            : old('certificate_valid_until');

        $this->duty_user_id = is_null(old('duty_user_id'))
            ? $this?->caution->duty_user_id
            : old('duty_user_id');

        $this->description = is_null(old('description'))
            ? $this?->caution->description
            : old('description');
    }

    protected function getComponentVariables()
    {
        return [
            'visitors' => app(VisitorsRepository::class)->allNotExited($this->visitor_id),
            'certificateTypes' => app(CertificateTypesRepository::class)->all(),
            'users' => app(UsersRepository::class)->all(),
        ];
    }

    public function mount()
    {
        $this->routine = app(RoutinesRepository::class)->findById($this->routine_id);

        if ($this->mode == 'create') {
            $this->caution = new Caution();
        }

        $this->redirect = request()->query('redirect');

        $this->fillModel();
    }

    public function render()
    {
        return view('livewire.cautions.form')->with($this->getViewVariables());
    }
}
