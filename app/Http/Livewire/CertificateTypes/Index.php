<?php

namespace App\Http\Livewire\CertificateTypes;

use App\Data\Repositories\CertificateTypes as CertificateTypesRepository;
use App\Http\Livewire\BaseIndex;

class Index extends BaseIndex
{
    protected $repository = CertificateTypesRepository::class;

    public $orderByField = ['name', 'id'];
    public $orderByDirection = [];
    public $paginationEnabled = true;

    public $searchFields = [
        'certificate_types.name' => 'text',
    ];

    public function render()
    {
        return view('livewire.certificate-types.index')->with([
            'certificateTypes' => $this->filter(),
        ]);
    }
}
