<?php

namespace App\Data\Repositories;

use App\Models\Country;

class Countries extends Repository
{
    /**
     * @var string
     */
    protected $model = Country::class;

    public function __get($key)
    {
        if (is_string($this->getAttribute($key))) {
            return convert_case($this->getAttribute($key), MB_CASE_UPPER);
        } else {
            return $this->getAttribute($key);
        }
    }

    public function allActive($id = null)
    {
        $tmpId = empty($id) ? null : $id;

        return $this->model
            ::where(function ($query) use ($tmpId) {
                $query
                    ->when(isset($tmpId), function ($query) use ($tmpId) {
                        $query->orWhere('id', '=', $tmpId);
                    })
                    ->orWhere('status', true);
            })
            ->orderBy('name')
            ->get();
    }
}
