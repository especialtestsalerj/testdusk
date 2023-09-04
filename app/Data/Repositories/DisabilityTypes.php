<?php

namespace App\Data\Repositories;

use App\Models\DisabilityType;

class DisabilityTypes extends Repository
{
    /**
     * @var string
     */
    protected $model = DisabilityType::class;

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
