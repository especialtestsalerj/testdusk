<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Traits\Swallable;
use Livewire\Component;
use Livewire\WithPagination;

abstract class BaseIndex extends Component
{
    use WithPagination, Swallable;

    protected $repository;
    protected $paginationTheme = 'bootstrap';
    public $searchString = '';
    public $pageSize = 12;
    protected $refreshFields = ['searchString'];
    protected $paginationEnabled = true;

    protected $listeners = ['update-field' => 'updateField'];

    protected $queryString = [
        'searchString' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    public function checkResetPage($field)
    {
        collect($this->refreshFields)->each(function ($refreshField) use ($field) {
            if ($field == $refreshField) {
                $this->resetPage();
            }
        });
    }

    public function updateField($event)
    {
        $field = $event['field'];
        $this->{$field} = $event['value'];

        if ($this->paginationEnabled) {
            $this->checkResetPage($field);
        }
    }

    public function updating($field)
    {
        if ($this->paginationEnabled) {
            $this->checkResetPage($field);
        }
    }

    public $searchFields = [];

    public function additionalFilterQuery($query)
    {
        return $query;
    }

    public function additionalOrFilterQuery($query)
    {
        return $query;
    }
    protected $orderByField = ['updated_at'];
    protected $orderByDirection = ['desc'];

    public function orderBy($query)
    {
        $sql = $query;
        $i = 0;
        foreach ($this->orderByField as $field) {
            $sql->orderBy($field, $this->orderByDirection[$i] ?? 'asc');
            $i++;
        }
        return $sql;
    }

    public function filter()
    {
        $repository = app($this->repository);

        if (!$this->paginationEnabled) {
            $repository->disablePagination();
        }

        $query = $repository
            ->newQuery()

            ->where(function ($query) {
                collect($this->searchFields)->each(function ($key, $field) use ($query) {
                    switch ($key) {
                        case 'text':
                            $query->when($this->searchString, function ($query) use ($field) {
                                $query->orWhereRaw(
                                    'unaccent(' .
                                        $field .
                                        ") ILIKE '%'||unaccent('" .
                                        pg_escape_string($this->searchString) .
                                        "')||'%' "
                                );
                            });
                            break;
                        case 'date':
                            $query->when($this->searchString, function ($query) use ($field) {
                                $query->orWhereRaw(
                                    'to_char(' .
                                        $field .
                                        ", 'DD/MM/YYYY HH:MI') LIKE '%" .
                                        $this->searchString .
                                        "%'"
                                );
                            });
                            break;
                        case 'protocol_number':
                            $query->when($this->searchString, function ($query) use ($field) {
                                $query->orWhereRaw(
                                    'CAST(' .
                                        $field .
                                        ' AS VARCHAR(10))' .
                                        " LIKE '%" .
                                        protocol_number_masked_to_bigint($this->searchString) .
                                        "%'"
                                );
                            });
                            break;
                    }
                });
                $query = $this->additionalOrFilterQuery($query);
            });

        $query = $this->additionalFilterQuery($query);


        $query = $this->orderBy($query);

        return $this->paginationEnabled ? $query->paginate($this->pageSize) : $query->get();
    }
}
