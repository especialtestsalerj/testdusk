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
                $query
                    ->when(isset($tmpId), function ($query) use ($tmpId) {
                        $query->orWhere('id', '=', $tmpId);
                    })
                    ->with('visitors')
                    ->orWhere('status', true);
            })
            ->orderBy('number')
            ->get();
    }
}

