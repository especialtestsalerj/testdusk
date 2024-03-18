<?php

namespace App\Http\Livewire\Cards;

use App\Data\Repositories\Cards as CardsRepository;
use App\Http\Livewire\BaseIndex;
use App\Http\Livewire\Traits\Checkoutable;
use App\Http\Livewire\Traits\Swallable;
use App\Models\Card;

class Index extends BaseIndex
{
    use Swallable, Checkoutable;

    protected $repository = CardsRepository::class;

    public $orderByField = ['number'];
    public $orderByDirection = [];
    public $paginationEnabled = true;
    protected $queryWith = ['visitors', 'building'];
    public $hasVisitor;

    public $searchFields = [
        'cards.number' => 'text',
    ];

    protected $listeners = [
        'disableAll',
        'enableAll',
        'refresh' => '$refresh',
        'confirm-checkout-visitor' => 'confirmCheckout',
    ];


    public function disableAllCards()
    {
        $this->swalConfirmation(
            'ATENÇÃO',
            'Você realmente quer desabilitar todos os cartões?',
            null,
            'disableAll',
        );
    }

    public function enableAllCards()
    {
        $this->swalConfirmation(
            'ATENÇÃO',
            'Você realmente quer habilitar todos os cartões?',
            null,
            'enableAll',
        );
    }

    public function disableAll()
    {
        $this->enableOrDisableAllFunction(false, 'Cartões desabilitados com sucesso!');
    }

    public function enableAll()
    {
        $this->enableOrDisableAllFunction(true, 'Cartões habilitados com sucesso!');
    }

    protected function enableOrDisableAllFunction($status, $message)
    {
        Card::query()->update(['status' => $status]);

        return to_route('cards.index')->with('message', $message);
    }

    public function createRestriction($person)
    {
        $this->emit('createRestriction', $person, get_current_building()->id);
    }

    public function additionalFilterQuery($query)
    {
        if ($this->hasVisitor) {
            $query = $query->whereHas('visitors', function ($subQuery) {
                $subQuery->whereNull('exited_at');
            });
        }
        return $query;
    }

    public function hasRestriction($card)
    {
        return $card->visitors->first()?->person->restrictions->contains('building_id', get_current_building()->id);
    }

    public function render()
    {
        return view('livewire.cards.index')->with(['cards' => $this->filter()]);
    }
}


