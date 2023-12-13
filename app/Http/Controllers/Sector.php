<?php

namespace App\Http\Controllers;
use App\Data\Repositories\Sectors as SectorsRepository;
use App\Http\Requests\SectorStore;
use App\Http\Requests\SectorUpdate;
use App\Http\Requests\SectorDestroy;
use App\Support\Constants;

class Sector extends Controller
{
    public function create()
    {
        formMode(Constants::FORM_MODE_CREATE);

        return $this->view('sectors.form')->with([
            'sector' => app(SectorsRepository::class)->new(),
            'currentBuilding' => get_current_building(),
        ]);
    }

    public function store(SectorStore $request)
    {
        app(SectorsRepository::class)->create($request->all());

        return redirect()
            ->route('sectors.index')
            ->with('message', 'Setor adicionado com sucesso!');
    }

    public function show($id)
    {
        formMode(Constants::FORM_MODE_SHOW);

        return $this->view('sectors.form')->with([
            'sector' => app(SectorsRepository::class)->findById($id),
        ]);
    }

    public function update(SectorUpdate $request, $id)
    {
        app(SectorsRepository::class)->update($id, $request->all());

        return redirect()
            ->route('sectors.index')
            ->with('message', 'Setor alterado com sucesso!');
    }

    public function destroy(SectorDestroy $request, $id)
    {
        $sector = app(SectorsRepository::class)->findById($id);

        $sector->delete($id);

        return redirect()
            ->route('sectors.index')
            ->with('message', 'Setor removido com sucesso!');
    }
}
