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

    public $orderByField = ['entranced_at'];
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

    public function additionalOrFilterQuery($query)
    {
        if (!is_null($this->searchString) && $this->searchString != '') {
            $accentedSearchString = pg_escape_string($this->searchString);
            $unaccentedSearchString = remove_punctuation($this->searchString);

            // Busca na tabela de people
            $query = $query->orWhereRaw(
                "visitors.person_id in (select id from people p
            where unaccent(p.full_name) ILIKE '%'||unaccent('" .
                    $accentedSearchString .
                    "')||'%'
            or unaccent(p.social_name) ILIKE '%'||unaccent('" .
                    $accentedSearchString .
                    "')||'%' )"
            );

            // Busca na tabela de documentos
            $query = $query->orWhereRaw(
                "visitors.person_id in (select person_id from documents d
            where regexp_replace(d.number, '[^a-zA-Z0-9]', '', 'g') ILIKE '%'||unaccent('" .
                    $unaccentedSearchString .
                    "')||'%')"
            );

            // Busca na tabela de setores
            $query = $query->orWhereRaw(
                "visitors.id in (select sv.visitor_id from sectors s, sector_visitor sv
             where sv.sector_id = s.id and  regexp_replace(s.name, '[^a-zA-Z0-9]', '', 'g') ILIKE '%'||unaccent('" .
                    pg_escape_string(remove_punctuation($this->searchString)) .
                    "')||'%')"
            );
        }

        $query->with('document.documentType');

        return $query;
    }

    public function additionalFilterQuery($query)
    {
        if ($this->openedExitFilter) {
            $query->where('exited_at', '!=', 'NULL');
            //            $query = $query->query(function ($query) {
            //                $query->where('exited_at', '!=', 'null');
            //            });
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
