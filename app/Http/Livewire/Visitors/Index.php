<?php

namespace App\Http\Livewire\Visitors;

use App\Data\Repositories\Visitors;
use App\Data\Repositories\Visitors as VisitorsRepository;
use App\Data\Repositories\Routines as RoutinesRepository;
use App\Http\Livewire\BaseIndex;
use App\Http\Livewire\Traits\Badgeable;
use App\Http\Livewire\Traits\ChangeViewType;
use App\Http\Livewire\Traits\Checkoutable;
use App\Models\Visitor;

class Index extends BaseIndex
{
    use Checkoutable, Badgeable, ChangeViewType;

    protected $repository = VisitorsRepository::class;
    protected $model = Visitor::class;
    protected $queryWith = ['document.documentType', 'person', 'card'];
    public $orderByField = ['entranced_at_original'];
    public $orderByDirection = ['desc'];
    public $paginationEnabled = true;
    public $routine_id;
    public $routine;
    public $redirect;
    public $countResults;
    public $openedExitFilter;

    public $exited_at;

    protected $queryString = [
        'searchString' => ['except' => ''],
        'openedExitFilter' => ['except' => false],
        'page' => ['except' => 1],
    ];

    protected $listeners = [
        'confirm-checkout-visitor' => 'confirmCheckout',
        'echo:visitors,VisitorsChanged' => '$refresh',
    ];

    public function mount()
    {
    }

    public function additionalFilterQuery($query)
    {
        if ($this->openedExitFilter) {
            //Hack to query exited_at IS NULL
            $query->where('exited_at IS NULL OR foo', '');
        }

        return $query;
    }

    public function render()
    {
        return view('livewire.visitors.index')->with([
            'pendingVisitors' => app(VisitorsRepository::class)->allPending(),
            'visitors' => $this->fullTextFilter(),
            'countVisitors' => $this->countResults,
        ]);
    }
}
