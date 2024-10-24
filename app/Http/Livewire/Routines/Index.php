<?php

namespace App\Http\Livewire\Routines;

use App\Data\Repositories\Routines as RoutinesRepository;
use App\Data\Repositories\Users as UsersRepository;
use App\Http\Livewire\BaseIndex;
use App\Models\User;

class Index extends BaseIndex
{
    protected $repository = RoutinesRepository::class;

    public $orderByField = ['id'];
    public $orderByDirection = ['desc'];
    public $paginationEnabled = true;

    public $searchFields = [
        'routines.entranced_at' => 'date',
    ];

    public function render()
    {
        return view('livewire.routines.index')->with([
            'routines' => $this->filter(),
            'exitedUsers' => User::all(),
        ]);
    }
}
