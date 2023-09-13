<?php

namespace App\Http\Controllers;
use App\Data\Repositories\CertificateTypes as CertificateTypesRepository;
use App\Http\Requests\CertificateTypeStore;
use App\Http\Requests\CertificateTypeUpdate;
use App\Http\Requests\CertificateTypeDestroy;
use App\Support\Constants;

class CertificateType extends Controller
{
    public function create()
    {
        formMode(Constants::FORM_MODE_CREATE);

        return $this->view('certificate-types.form')->with([
            'certificateType' => app(CertificateTypesRepository::class)->new(),
        ]);
    }

    public function store(CertificateTypeStore $request)
    {
        app(CertificateTypesRepository::class)->create($request->all());

        return redirect()
            ->route('certificate-types.index')
            ->with('message', 'Tipo de Porte adicionado com sucesso!');
    }

    public function show($id)
    {
        formMode(Constants::FORM_MODE_SHOW);

        return $this->view('certificate-types.form')->with([
            'certificateType' => app(CertificateTypesRepository::class)->findById($id),
        ]);
    }

    public function update(CertificateTypeUpdate $request, $id)
    {
        app(CertificateTypesRepository::class)->update($id, $request->all());

        return redirect()
            ->route('certificate-types.index')
            ->with('message', 'Tipo de Porte alterado com sucesso!');
    }

    public function destroy(CertificateTypeDestroy $request, $id)
    {
        $certificateType = app(CertificateTypesRepository::class)->findById($id);

        $certificateType->delete($id);

        return redirect()
            ->route('certificate-types.index')
            ->with('message', 'Tipo de Porte removido com sucesso!');
    }
}
