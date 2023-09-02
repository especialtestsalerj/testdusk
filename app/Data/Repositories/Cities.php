<?php

namespace App\Data\Repositories;

use App\Models\City;

class Cities extends Repository
{
    /**
     * @var string
     */
    protected $model = City::class;

    public function allActive($id = null)
    {
        return $this->model
            ::where(function ($query) use ($id) {
                $query
                    ->when(isset($id), function ($query) use ($id) {
                        $query->orWhere('id', '=', $id);
                    })
                    ->orWhere('status', true);
            })
            ->orderBy('name')
            ->get();
    }
}
