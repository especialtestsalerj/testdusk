<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @param string $message
     *
     * @return array
     */
    public function getSuccessMessage($message = 'Gravado com sucesso')
    {
        return ['message' => $message];
    }

    public function view($name)
    {
        return view($name)
            ->with('search', request('search'))
            ->with('query', request()->get('query'));
    }
}
