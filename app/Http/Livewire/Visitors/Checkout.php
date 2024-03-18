<?php

namespace App\Http\Livewire\Visitors;

use App\Data\Repositories\Visitors;
use App\Http\Livewire\BaseIndex;
use App\Http\Livewire\Traits\ChangeViewType;
use App\Models\Visitor;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Database\Eloquent\Builder;
use Ramsey\Uuid\Uuid;

class Checkout extends BaseIndex
{
    use ChangeViewType;
    protected $queryWith = ['document.documentType', 'sectors', 'person'];
    public $searchName;
    public $startDate;
    public $endDate;

    protected $refreshFields = ['searchName', 'pageSize', 'startDate', 'endDate'];

    protected $queryString = [
        'searchName' => ['except' => ''],
        'pageSize' => ['except' => 12],
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
        $query = $this->filterPersonNameAndSectorName($query);
        $query = $this->filterDates($query);

        return $query->whereNotNull('visitors.exited_at');
    }

    protected function extractUuidFromUrl($visitorUrl)
    {
        $pattern = '/\/([^\/?]+)(?:\?|$)/';

        if (preg_match($pattern, $visitorUrl, $matches)) {
            $result = $matches[1];
        }

        return $result ?? null;
    }

    public function scan($detail)
    {
        $regexResult = $this->extractUuidFromUrl($detail['decodedText']);

        if ($this->isAnonymous($regexResult)) {
            $this->dispatchAnonymousFailure();
        } else {
            $this->attemptCheckout($regexResult);
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
     * @param $query
     * @return mixed
     */
    protected function filterDates($query): mixed
    {
        return $query->wasThereBetweenDates($this->startDate, $this->endDate);
    }

    /**
     * @param mixed $uuid
     * @return void
     */
    protected function attemptCheckout(mixed $uuid): void
    {
        if ($uuid && Uuid::isValid($uuid) && ($visitor = Visitor::findByUuid($uuid))) {
            if ($visitor->checkout()) {
                $this->dispatchCheckoutSuccessSwal($visitor);
            } else {
                $this->dispatchBrowserEvent('swal-checkout-failure', [
                    'error' => 'Checkout já realizado',
                ]);
            }
        } else {
            $this->dispatchBrowserEvent('swal-checkout-failure', [
                'error' => 'QRcode já usado ou não reconhecido',
            ]);
        }
    }

    /**
     * @param mixed $regexResult
     * @return bool
     */
    protected function isAnonymous(mixed $regexResult): bool
    {
        return $regexResult == 'card';
    }

    /**
     * @return void
     */
    protected function dispatchAnonymousFailure(): void
    {
        $this->dispatchBrowserEvent('swal-checkout-failure', [
            'error' => 'Etiqueta avulsa',
        ]);
    }

    /**
     * @param $query
     * @return mixed
     */
    protected function filterPersonNameAndSectorName($query): mixed
    {
        if ($this->searchName) {
            $query = $query
                ->join('people', 'visitors.person_id', '=', 'people.id')
                ->join('sector_visitor', 'visitors.id', '=', 'sector_visitor.visitor_id')
                ->join('sectors', 'sector_visitor.sector_id', '=', 'sectors.id')

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
                        )
                        ->orWhereRaw(
                            "\"sectors\".\"name\" ILIKE '%' || unaccent('" .
                                pg_escape_string($this->searchName) .
                                "') || '%'"
                        );
                });
        }
        return $query;
    }
}
