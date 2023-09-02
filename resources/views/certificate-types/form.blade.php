@extends('layouts.app')

@section('content')
    <div class="py-4 px-4">
        <form name="formulario" id="formulario" @if(formMode() == 'show') action="{{ route('certificate-types.update', ['id' => $certificateType->id]) }}" @else action="{{ route('certificate-types.store')}}" @endIf method="POST">
            @csrf
            <input name="id" type="hidden" value="{{$certificateType->id}}" id="id" >

            <div class="">
                <div class="row">
                    <div class="col-sm-8 align-self-center">
                        <h3 class="mb-0">
                            <a href="{{ route('certificate-types.index') }}"><i class="fa fa-list-ol"></i> Tipos de Porte</a>

                            @if(is_null($certificateType->id))
                                > Novo
                            @else
                                > {{ $certificateType->id }} - {{ $certificateType->name }}
                            @endif
                        </h3>
                    </div>

                    <div class="col-sm-4 align-self-center d-flex justify-content-end gap-4">
                        @include('partials.save-button', ['model' => $certificateType, 'backUrl' => 'certificate-types.index', 'permission' => (formMode() == 'show' ? 'certificate-types:update' : 'certificate-types:store')])
                    </div>
                </div>
            </div>

            <div class="card-body my-2">
                @include('layouts.msg')
                <div class="row">
                    <div class="col-12 d-flex justify-content-end">
                        <span class="badge bg-info text-black required-msg"><i class="fa fa-circle-info"></i> * Campos obrigatórios</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="name">Nome*</label>
                            <input class="form-control text-uppercase" id="name" name="name" value="{{is_null(old('name')) ? $certificateType->name : old('name')}}" @include('partials.disabled', ['model' => $certificateType, 'permission' => 'certificate-types:store'])/>
                        </div>

                        <div class="form-group">
                            <label for="status">Status*</label>
                            <div class="form-check">
                                <input class="form-control" type="hidden" name="status" value="false">
                                <input class="form-check-input" type="checkbox" dusk="checkboxCertificateTypes" id="status" name="status" {{(is_null(old('status')) ? (formMode() == 'create' ? true : $certificateType->status) : old('status')) ? 'checked="checked"' : ''}} @include('partials.disabled', ['model' => $certificateType, 'permission' => 'certificate-types:store'])>
                                <label class="form-check-label" for="status">Ativo</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
