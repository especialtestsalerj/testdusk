<?php

namespace App\Http\Livewire\Cautions;

use App\Data\Repositories\CertificateTypes as CertificateTypesRepository;
use App\Data\Repositories\Users as UsersRepository;
use App\Data\Repositories\Visitors as VisitorsRepository;

class UpdateForm extends CreateForm
{
    public $mode = 'show';

    protected function getComponentVariables()
    {
        return [
            'caution' => $this->caution,
            'visitors' => app(VisitorsRepository::class)->allNotExited($this->visitor_id),
            'certificateTypes' => app(CertificateTypesRepository::class)->all(),
            'users' => app(UsersRepository::class)->all(),
        ];
    }
}
