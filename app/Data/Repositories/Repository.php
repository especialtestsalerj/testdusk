<?php

namespace App\Data\Repositories;

use Exception;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;

abstract class Repository
{
    public $perPage = 10;

    public function all()
    {
        return $this->applyFilter($this->newQuery());
    }

    public function allOrderBy($field, $direction, $limit)
    {
        return $this->model
            ::orderBy($field, $direction)
            ->limit($limit)
            ->get();
    }

    public function allOrderByPaginate($field, $direction)
    {
        return $this->applyFilter($this->newQuery(), $field, $direction);
    }

    /**
     * @return mixed
     */
    public function new()
    {
        return new $this->model();
    }

    /**
     * @param $data
     *
     * @return mixed
     */
    public function create($data)
    {
        $model = is_null($id = isset($data['id']) ? $data['id'] : null)
            ? new $this->model()
            : $this->newQuery()
                ->where('id', $id)
                ->first();

        $model->fill($data);

        $model->save();

        return $model;
    }

    /**
     * @param $id
     * @param $array
     * @return mixed
     */
    public function update($id, $array = null)
    {
        return $this->fillAndSave($array ?? $this->data, $this->findById($id));
    }

    /**
     * @param $array
     * @param $model
     * @return mixed
     */
    protected function fillAndSave($array, $model)
    {
        $model->fill($array);

        $model->save();

        return $model;
    }

    /**
     * @param $name
     * @param $arguments
     * @return mixed
     * @throws Exception
     */
    public function __call($name, $arguments)
    {
        if (starts_with($name, 'findBy')) {
            return $result = $this->findByAnyColumnName($name, $arguments);
        }

        if (starts_with($name, 'filterBy')) {
            return $result = $this->filterByAnyColumnName($name, $arguments);
        }

        if (starts_with($name, 'getBy')) {
            return $result = $this->getByAnyColumnName($name, $arguments);
        }

        //throw new Exception('Method not found: ' . $name);
    }

    protected function findByAnyColumnName($name, $arguments)
    {
        return $this->makeQueryByAnyColumnName('findBy', $name, $arguments)->first();
    }

    protected function getByAnyColumnName($name, $arguments)
    {
        return $this->makeQueryByAnyColumnName('getBy', $name, $arguments)->get();
    }

    protected function makeQueryByAnyColumnName($type, $name, $arguments, $query = null)
    {
        if (!$query) {
            $query = $this->newQuery($type);
        }

        $columnName = snake_case(Str::after($name, $type));

        return $query->where($this->qualifyColumn($columnName), $arguments);
    }

    public function disablePagination()
    {
        $this->paginate = false;

        return $this;
    }

    public function setPerPage($perPage)
    {
        $this->perPage = $perPage;

        return $this;
    }

    /**
     * @param null $type
     * @return Builder
     */
    public function newQuery($type = null)
    {
        $query = $this->model::query();

        return $query;
    }

    protected function qualifyColumn($name)
    {
        return $this->model()->qualifyColumn($name);
    }

    /**
     * @return mixed
     */
    public function model()
    {
        return $this->new();
    }

    protected function applyFilter($query, $orderBy = null, $orderByDirection = null)
    {
        $queryFilter = $this->getQueryFilter();

        $this->filterText($queryFilter, $query);

        if (
            isset($queryFilter->toArray()['pagination']['current_page']) &&
            $queryFilter->toArray()['pagination']['current_page'] == 0
        ) {
            $queryFilter = $this->allElements($queryFilter);
        }

        if ($orderBy) {
            if ($orderByDirection) {
                $query->orderBy($orderBy);
            } else {
                $query->orderBy($orderBy, $orderByDirection);
            }
        }

        return $query->paginate(
            isset($this->paginate) && $this->paginate ? $this->perPage : 10000,
            ['*'],
            'page',
            $queryFilter->get('pagination') && $queryFilter->get('pagination')['current_page']
                ? $queryFilter->get('pagination')['current_page']
                : 1
            /*$queryFilter->pagination && $queryFilter->pagination->currentPage
                    ? $queryFilter->pagination->currentPage
                    : 1*/
        );
    }

    protected function getQueryFilter()
    {
        $queryFilter = is_array(request()->get('query'))
            ? request()->get('query')
            : json_decode(request()->get('query'), true);

        $queryFilter['search'] = request()->get('search');

        $queryFilter['pagination'] = $queryFilter['pagination'] ?? [];

        $queryFilter['pagination']['current_page'] =
            $queryFilter['pagination']['current_page'] ?? (request()->get('page') ?? 1);

        $queryFilter['pagination']['per_page'] = $queryFilter['pagination']['per_page'] ?? 20;

        return collect($queryFilter);
    }

    protected function filterText($filter, $query)
    {
        if ($text = $filter['filter']['text'] ?? null) {
            $this->filterAllColumns($query, $text);
        }

        if ($text = $filter['search']) {
            $this->filterAllColumns($query, $text);
        }

        return $query;
    }

    protected function filterAllColumns($query, $text)
    {
        if (
            $this->model()
                ->getFilterableColumns()
                ->count() > 0
        ) {
            $query->where(function ($newQuery) use ($query, $text) {
                $this->model()
                    ->getFilterableColumns()
                    ->each(function ($column) use ($newQuery, $text) {
                        $newQuery->orWhere($column, 'ilike', "%{$text}%");
                    });
            });
        }

        return $query;
    }
}
