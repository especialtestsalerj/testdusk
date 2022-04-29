<?php

namespace App\Data\Traits;

trait Joinable
{
    public function getJoins()
    {
        return coollect(isset($this->joins) ? $this->joins : []);
    }
}
