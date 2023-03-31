@extends('layouts.app')

@section('content')
    <div class="py-4 px-4">
        <form name="formulario" id="formulario" @if(formMode() == 'show') action="{{ route('sectors.update', ['id' => $sector->id]) }}" @else action="{{ route('sectors.store')}}" @endIf method="POST">
            @csrf
            <input name="id" type="hidden" value="{{$sector->id}}" id="id" >

            <div class="">
                <div class="row">
                    <div class="col-sm-8 align-self-center">
                        <h4 class="mb-0">
                            <a href="{{ route('sectors.index') }}">Setores</a>

                            @if(is_null($sector->id))
                                > Novo
                            @else
                                > {{ $sector->id }} - {{ $sector->name }}
                            @endif
                        </h4>
                    </div>

                    <div class="col-sm-4 align-self-center d-flex justify-content-end">
                        @include('partials.save-button', ['model' => $sector, 'backUrl' => 'sectors.index', 'permission' => (formMode() == 'show' ? 'sectors:update' : 'sectors:store')])
                    </div>
                </div>
            </div>

            <div class="card-body mx-4 my-2">
                @include('layouts.msg')
                <div class="row">
                    <div class="col-12 d-flex justify-content-end">
                        <span class="badge bg-warning text-black required-msg">* Campos obrigatórios </span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="name">Nome*</label>
                            <input class="form-control text-uppercase" id="name" name="name" value="{{is_null(old('name')) ? $sector->name : old('name')}}" @include('partials.disabled', ['model' => $sector, 'permission' => 'sectors:store'])/>
                        </div>

                        <div class="form-group">
                            <label for="status">Status*</label>
                            <div class="form-check">
                                <input class="form-control" type="hidden" name="status" value="false">
                                <input class="form-check-input" dusk="checkboxSectors" type="checkbox" id="status" name="status" {{(is_null(old('status')) ? (formMode() == 'create' ? true : $sector->status) : old('status')) ? 'checked="checked"' : ''}} @include('partials.disabled', ['model' => $sector, 'permission' => 'sectors:store'])>
                                <label class="form-check-label" for="status">Ativo</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
