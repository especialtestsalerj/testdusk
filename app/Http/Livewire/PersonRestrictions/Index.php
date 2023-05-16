<?php

namespace App\Http\Livewire\PersonRestrictions;

use App\Data\Repositories\PersonRestrictions as PersonRestrictionsRepository;
use App\Http\Livewire\BaseIndex;

class Index extends BaseIndex
{
    protected $repository = PersonRestrictionsRepository::class;

    public $orderByField = ['started_at', 'id'];
    public $orderByDirection = [];
    public $paginationEnabled = true;

    public $searchFields = [
        'personRestrictions.started_at' => 'date',
    ];

    public function render()
    {
        return view('livewire.person-restrictions.index')->with([
            'personRestrictions' => $this->filter(),
        ]);
    }
}
