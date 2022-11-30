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

    public function finish(RoutinesRequest $request)
    {
        dd('index');
        /*$data = $request->all();

        $model = $this->model::find($data->id);

        $data->merge(['status' => false]);
        $model->fill($data->toArray());
        $model->save();

        return redirect()
            ->route('routines.index')
            ->with('status', 'Rotina finalizada com sucesso!');*/
    }

    public function render()
    {
        return view('livewire.routines.index')->with([
            'routines' => $this->filter(),
            'exitedUsers' => app(UsersRepository::class)->all('name'),
        ]);
    }
}
