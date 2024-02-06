<?php

namespace App\Data\Repositories;

use App\Models\Card;

class Cards extends Repository
{
    protected string $model = Card::class;

    public function allActive($id = null)
    {
        $tmpId = empty($id) ? null : $id;

        return $this->model
            ::where(function ($query) use ($tmpId) {
                $query->when(isset($tmpId), function ($query) use ($tmpId) {
                    $query->where('id', '=', $tmpId);
                });
                $query->orWhere(function ($query) {
                    $query->where(function ($query) {
                        $query->whereDoesntHave('visitors', function ($query) {
                            $query->whereNull('exited_at');
                        });
                    })->orWhere(function ($query) {
                        $query->whereHas('visitors', function ($query) {
                            $query->whereNotNull('exited_at');
                        });
                    });
                });
            })
            ->whereNot(function ($query) use ($tmpId) {
                $query->where('id', '!=', $tmpId)
                    ->where('status', false);
            })
            ->orderBy('number')
            ->get();
    }
}

