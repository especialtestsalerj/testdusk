<?php

namespace App\Http\Livewire\Visitors;

use App\Data\Repositories\Visitors;
use App\Http\Livewire\BaseIndex;
use App\Models\Visitor;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Database\Eloquent\Builder;

class Checkout extends BaseIndex
{
    public $searchName;
    public $startDate;
    public $endDate;

    protected $refreshFields = ['searchName', 'pageSize', 'startDate', 'endDate'];

    protected $queryString = [
        'searchName' => ['except' => ''],
        'pageSize' => ['except' => '10'],
        'page' => ['except' => 1],
        'startDate' => ['except' => ''],
        'endDate' => ['except' => ''],
    ];

    protected $repository = Visitors::class;
    protected $orderByField = ['exited_at'];
    protected $orderByDirection = ['desc'];

    protected $listeners = [
        'echo:visitors,VisitorsChanged' => '$refresh',
    ];

    public function render()
    {
        return view('livewire.visitors.checkout')->with([
            'visitors' => $this->filter(),
        ]);
    }

    public function additionalFilterQuery($query)
    {
        if ($this->searchName) {
            $query = $query
                ->join('people', 'visitors.person_id', '=', 'people.id')
                ->where(function ($query) {
                    $query
                        ->orWhereRaw(
                            "\"people\".\"full_name\" ILIKE '%' || unaccent('" .
                                pg_escape_string($this->searchName) .
                                "') || '%'"
                        )
                        ->orWhereRaw(
                            "\"people\".\"social_name\" ILIKE '%' || unaccent('" .
                                pg_escape_string($this->searchName) .
                                "') || '%'"
                        );
                });
        }

        $this->filterDates($query);

        $query = $query->whereNotNull('visitors.exited_at');

        return $query;
    }

    protected function extractUuidFromUrl($visitorUrl)
    {
        $pattern = '/\/([^\/?]+)(?:\?|$)/';

        if (preg_match($pattern, $visitorUrl, $matches)) {
            $uuid = $matches[1];
        }

        return $uuid ?? null;
    }

    public function scan($detail)
    {
        $uuid = $this->extractUuidFromUrl($detail['decodedText']);

        //TODO: verificar se é anônimo

        if ($uuid && ($visitor = Visitor::findByUuid($uuid))) {
            if ($visitor->checkout()) {
                $this->dispatchCheckoutSuccessSwal($visitor);
            } else {
                $this->dispatchBrowserEvent('swal-checkout-failure', [
                    'error' => 'Checkout já realizado',
                ]);
            }
        } else {
            $this->dispatchBrowserEvent('swal-checkout-failure', [
                'error' => 'QR code não reconhecido',
            ]);
        }

        $this->resetPage();
    }

    /**
     * @param $visitor
     * @return void
     */
    protected function dispatchCheckoutSuccessSwal($visitor): void
    {
        $this->dispatchBrowserEvent('swal-checkout-success', [
            'title' => 'Checkout realizado',
            'photo' => $visitor->photo,
            'name' => $visitor->person->name,
        ]);
    }

    /**
     * @param mixed $query
     * @return void
     */
    protected function filterDates(mixed $query): void
    {
        // Check if both $startDate and $endDate are provided
        if ($this->startDate && $this->endDate) {
            $query->whereRaw(
                '(("entranced_at" >= ? and "entranced_at" <= ?) or ("exited_at" >= ? and "exited_at" <= ?))',
                [$this->startDate, $this->endDate, $this->startDate, $this->endDate]
            );
        }
        // Check if only $this->startDate is provided
        elseif ($this->startDate) {
            $query->where(
                fn($query) => $query
                    ->orWhere('entranced_at', '>=', $this->startDate)
                    ->orWhere('exited_at', '>=', $this->startDate)
            );
        }
        // Check if only $this->endDate is provided
        elseif ($this->endDate) {
            $query->where(
                fn($query) => $query
                    ->orWhere('entranced_at', '<=', $this->endDate)
                    ->orWhere('exited_at', '<=', $this->endDate)
            );
        }
    }
}
