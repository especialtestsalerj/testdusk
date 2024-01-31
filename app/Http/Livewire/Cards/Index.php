<?php

namespace App\Http\Livewire\Cards;

use App\Data\Repositories\Cards as CardsRepository;
use App\Http\Livewire\BaseIndex;

class Index extends BaseIndex
{
    protected $repository = CardsRepository::class;

    public $orderByField = ['number'];
    public $orderByDirection = [];
    public $paginationEnabled = true;

    public $searchFields = [
        'cards.number' => 'text',
    ];

    public function render()
    {
        return view('livewire.cards.index')->with(['cards' => $this->filter()]);
    }
}


