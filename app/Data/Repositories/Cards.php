<?php

namespace App\Data\Repositories;

use App\Models\Card;

class Cards extends Repository
{
    protected string $model = Card::class;

    public function allActive($id = null)
    {
        $tmpId = empty($id) ? null : $id;

//        return $this->model
//            ::where(function ($query) use ($tmpId) {
//                $query
//                    ->when(isset($tmpId), function ($query) use ($tmpId) {
//                        $query->orWhere('id', '=', $tmpId);
//                    })
//                    ->orWhere('status', true);
//            })
////                if (is_null($tmpId)) {
////                    $query->where(function ($query) {
////                        $query->orWhereDoesntHave('visitors', function ($query) {
////                            $query->whereNull('exited_at');
////                        })
////                            ->orWhere('status', true);
////                    });
////                }
//
//            ->orderBy('number')
//            ->get();

//        return $this->model
//            ::where(function ($query) use ($tmpId) {
//                $query
//                    ->when(isset($tmpId), function ($query) use ($tmpId) {
//                        $query->orWhere('id', '=', $tmpId);
//                    });
//            });
//            if (is_null($tmpId)) {
//                $query->where(function ($query) {
//                    $query->orWhereDoesntHave('visitors', function ($query) {
//                        $query->whereNull('exited_at');
//                    })
//                        ->orWhere('status', true);
//                });
//            }
//
//        $query->orderBy('number')
//            ->get();
//    }

        return $this->model
            ::where(function ($query) use ($tmpId) {
                $query
                    ->when(isset($tmpId), function ($query) use ($tmpId) {
                        $query->orWhere('id', '=', $tmpId);
                    })
                     ->orWhere(function ($query) use ($tmpId) {
                         if (is_null($tmpId)) {
                             $query->whereDoesntHave('visitors', function ($query) {
                                 $query->whereNull('exited_at');
                             })
                                 ->orWhere('status', true);
                         }
                     });
            })
            ->orderBy('number')
            ->get();
    }


//if (is_null($tmpId)) {
//$query->where(function ($query) {
//    $query->orWhereDoesntHave('visitors', function ($query) {
//        $query->whereNull('exited_at');
//    })
//        ->orWhere('status', true);
//});
//}
}

