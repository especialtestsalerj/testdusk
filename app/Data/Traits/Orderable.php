<?php

namespace App\Data\Traits;

trait Orderable
{
    public function getOrderBy()
    {
        return coollect(isset($this->orderBy) ? $this->orderBy : []);
    }
}
