<?php

namespace App\Http\Livewire\Cards;

use App\Data\Repositories\Cards as CardsRepository;
use App\Http\Livewire\BaseIndex;
use App\Http\Livewire\Traits\Swallable;

class Index extends BaseIndex
{
    use Swallable;

    protected $repository = CardsRepository::class;

    public $orderByField = ['number'];
    public $orderByDirection = [];
    public $paginationEnabled = true;
    protected $queryWith = ['visitors'];
    public $hasVisitor;

    public $searchFields = [
        'cards.number' => 'text',
    ];


    public function disableAllCards()
    {
        $this->swalConfirmation(
            'ATENÇÃO',
            'Você realmente quer desabilitar todos os cartões?',
            route('cards.disable_all')
        );
    }

    public function enableAllCards()
    {
        $this->swalConfirmation(
            'ATENÇÃO',
            'Você realmente quer habilitar todos os cartões?',
            route('cards.enable_all')
        );
    }

    public function additionalFilterQuery($query)
    {
        if ($this->hasVisitor) {
            $query = $query->orWhereHas('visitors', function ($subQuery) {
                $subQuery->whereNull('exited_at');
            });
        }
        return $query;
    }

    public function render()
    {
        return view('livewire.cards.index')->with(['cards' => $this->filter()]);
    }
}


