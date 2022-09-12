<?php

namespace App\Http\Controllers;
use App\Http\Requests\SectorStore as SectorRequest;
use App\Data\Repositories\Sectors as SectorsRepository;
use App\Http\Requests\SectorUpdate as SectorUpdateRequest;
use App\Support\Constants;

class Sector extends Controller
{
    public function index()
    {
        return $this->view('sectors.index')->with('sectors', app(SectorsRepository::class)->all());
    }

    public function create()
    {
        formMode(Constants::FORM_MODE_CREATE);

        return $this->view('sectors.form')->with([
            'sector' => app(SectorsRepository::class)->new(),
        ]);
    }

    public function store(SectorRequest $request)
    {
        app(SectorsRepository::class)->create($request->all());

        return redirect()->route('sectors.index')->with('status', 'Setor criado com sucesso!');
    }

    public function show($id)
    {
        return $this->view('sectors.form')->with([
            'sector' => app(SectorsRepository::class)->findById($id),
        ]);
    }

    public function update(SectorUpdateRequest $request, $id)
    {
        app(SectorsRepository::class)->update($id, $request->all());

        return redirect()->route('sectors.index')->with('status', 'Setor editado com sucesso!');
    }
}
