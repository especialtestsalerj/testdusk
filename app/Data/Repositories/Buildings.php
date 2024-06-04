<?php

namespace App\Data\Repositories;

use App\Models\Building;

class Buildings extends Repository
{
    /**
     * @var string
     */
    protected $model = Building::class;

    public function getMainBuilding()
    {
        //        return Building::where('slug', 'palacio-tiradentes')->first();
        return Building::where('slug', 'lucio-costa')->first();
        return \Cache::remember('main-building', 60, function () {
            return Building::where('slug', 'lucio-costa')->first();
        });
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
