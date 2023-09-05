<?php

namespace App\Data\Repositories;

use App\Models\DisabilityType;

class DisabilityTypes extends Repository
{
    /**
     * @var string
     */
    protected $model = DisabilityType::class;

    public function allActive(array $ids = [])
    {
        return $this->model
            ::where(function ($query) use ($ids) {
                $query
                    ->when(isset($ids), function ($query) use ($ids) {
                        $query->whereIn('id', $ids);
                    })
                    ->orWhere('status', true);
            })
            ->orderBy('name')
            ->get();
    }
}
