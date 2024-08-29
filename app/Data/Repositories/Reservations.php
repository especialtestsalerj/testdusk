<?php

namespace App\Data\Repositories;

use App\Models\Reservation;
use Carbon\Carbon;

class Reservations extends Repository
{
    /**
     * @var string
     */
    protected $model = Reservation::class;

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


    public function recoveryFromDocument($documentNUmber){
        return $this->model::where('reservation_status_id', '!=', 5)
            ->where('person->document_number', $documentNUmber)
            ->whereDate('reservation_date', '>=', Carbon::today())
            ->get();
    }
}
