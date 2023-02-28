<?php

namespace App\Http\Livewire\Routines;

use App\Data\Repositories\Routines as RoutinesRepository;
use App\Data\Repositories\Users as UsersRepository;
use App\Http\Livewire\BaseIndex;
use App\Http\Requests\Request;
use App\Http\Requests\RoutineUpdate as RoutinesRequest;
use App\Models\Routine;

class Index extends BaseIndex
{
    protected $repository = RoutinesRepository::class;
    private $model = Routine::class;

    public $orderByField = 'entranced_at';
    public $orderByDirection = 'desc';
    public $paginationEnabled = true;

    public $searchFields = [
        'routines.entranced_at' => 'date',
    ];

    public function render()
    {
        return view('livewire.routines.index')->with([
            'routines' => $this->filter(),
            'exitedUsers' => app(UsersRepository::class)->all('name'),
        ]);
    }
}
