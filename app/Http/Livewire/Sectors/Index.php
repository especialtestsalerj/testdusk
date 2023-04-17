<?php

namespace App\Http\Livewire\Sectors;

use App\Data\Repositories\Sectors as SectorsRepository;
use App\Http\Livewire\BaseIndex;

class Index extends BaseIndex
{
    protected $repository = SectorsRepository::class;

    public $orderByField = ['name'];
    public $orderByDirection = [];
    public $paginationEnabled = true;

    public $searchFields = [
        'sectors.name' => 'text',
    ];

    public function render()
    {
        return view('livewire.sectors.index')->with(['sectors' => $this->filter()]);
    }
}
