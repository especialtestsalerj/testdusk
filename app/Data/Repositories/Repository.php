<?php

namespace App\Data\Repositories;

use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Data\Traits\Eventable;
use App\Data\Traits\DataProcessing;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;

abstract class Repository
{
    public function all()
    {
        return $this->model::all();
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

        throw new Exception('Method not found: ' . $name);
    }

    protected function findByAnyColumnName($name, $arguments)
    {
        return $this->makeQueryByAnyColumnName('findBy', $name, $arguments)->first();
    }

    protected function makeQueryByAnyColumnName($type, $name, $arguments, $query = null)
    {
        if (!$query) {
            $query = $this->newQuery($type);
        }

        $columnName = snake_case(Str::after($name, $type));

        return $query->where($this->qualifyColumn($columnName), $arguments);
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
}
