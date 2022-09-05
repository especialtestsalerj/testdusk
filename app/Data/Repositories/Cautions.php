<?php

namespace App\Data\Repositories;

use App\Models\Caution;

class Cautions extends Repository
{
    /**
     * @var string
     */
    protected $model = Caution::class;

    //Retornar o próximo número de protocolo para o ano de criação da nova cautela
    public function makeProtocolNumber($ano)
    {
        $new_number =
            $this->model
                ::whereRaw("DATE_PART('year', started_at) = " . $ano)
                ->max('protocol_number') + 1;
        $new_number =
            $new_number == '1' ? $ano . str_pad($new_number, 4, '0', STR_PAD_LEFT) : $new_number;

        return $new_number;
    }
}
