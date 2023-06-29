<?php

namespace App\Http\Livewire\Visitors;

use App\Data\Repositories\Visitors;
use App\Data\Repositories\Visitors as VisitorsRepository;
use App\Data\Repositories\Routines as RoutinesRepository;
use App\Http\Livewire\BaseIndex;
use App\Http\Livewire\Traits\Checkoutable;
use App\Models\Visitor;

class Index extends BaseIndex
{
    use Checkoutable;

    protected $repository = VisitorsRepository::class;

    public $orderByField = ['entranced_at'];
    public $orderByDirection = ['desc'];
    public $paginationEnabled = true;
    public $routine_id;
    public $routine;
    public $redirect;
    public $printVisitor;

    public $searchFields = [
        'visitors.entranced_at' => 'date',
        'visitors.exited_at' => 'date',
    ];

    protected $listeners = [
        'confirm-checkout-visitor' => 'confirmCheckout',
        'echo:visitors,VisitorsChanged' => '$refresh',
    ];

    public function mount()
    {
//        $this->loadAnonymousVisitor();
    }

    public function additionalFilterQuery($query)
    {
        if (!is_null($this->searchString) && $this->searchString != '') {
            //Busca na tabela de people
            $query = $query->orWhereRaw(
                "visitors.person_id in (select id from people p
             where p.full_name ILIKE '%'||unaccent('" .
                    pg_escape_string($this->searchString) .
                    "')||'%'
                                        or p.social_name ILIKE '%'||unaccent('" .
                    pg_escape_string($this->searchString) .
                    "')||'%' )"
            );
            //busca na tabela de documentos
            $query = $query->orWhereRaw(
                "visitors.person_id in (select id from documents d
             where d.number ILIKE '%'||unaccent('" .
                    pg_escape_string($this->searchString) .
                    "')||'%')"
            );
        }

        $query->with('document.documentType');

        return $query;
    }

    public function generateBadge($visitor_id)
    {
        $this->printVisitor = null;

        if (!empty($visitor_id)) {
            $this->printVisitor = app(VisitorsRepository::class)->findById([$visitor_id]);
        } else {
            $this->loadAnonymousVisitor();
        }

        $this->printVisitor->append(['photo','qr_code_uri']);

        $this->dispatchBrowserEvent('printBadge');
    }

    private function loadAnonymousVisitor()
    {
        $this->printVisitor = app(Visitors::class)->getAnonymousVisitor();

    }

    public function render()
    {
        return view('livewire.visitors.index')->with(['visitors' => $this->filter()]);
    }
}
