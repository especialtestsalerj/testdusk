<?php

namespace App\Data\Repositories;

use App\Models\Card;

class Cards extends Repository
{
    protected string $model = Card::class;

    public function allActive($id = null): void
    {
        $this->getAllActive($this->model, 'number', $id);
    }
}

