@extends('layouts.app')

@section('content')
    <div class="card card-default mx-0 my-0 mx-lg-5 my-lg-4">
        <form name="formulario" id="formulario" @if(formMode() == 'show') action="{{ route('event-types.update', ['id' => $eventType->id]) }}" @else action="{{ route('event-types.store')}}" @endIf method="POST">
            @csrf
            <input name="id" type="hidden" value="{{$eventType->id}}" id="id" >

            <div class="card-header py-4 px-4">
                <div class="row">
                    <div class="col-sm-8 align-self-center">
                        <h4 class="mb-0">
                            <a href="{{ route('event-types.index') }}">Tipos de Ocorrência</a>

                            @if(is_null($eventType->id))
                                > Novo
                            @else
                                > {{ $eventType->id }} - {{ $eventType->name }}
                            @endif
                        </h4>
                    </div>

                    <div class="col-sm-4 align-self-center d-flex justify-content-end">
                        @include('partials.save-button', ['model'=>$eventType, 'backUrl' => 'event-types.index', 'permission'=>'event-types:store'])
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
                            <input class="form-control text-uppercase" id="name" name="name" value="{{is_null(old('name')) ? $eventType->name : old('name')}}" @include('partials.disabled', ['model'=>$eventType, 'permission'=>'event-types:store'])/>
                        </div>

                        <div class="form-group">
                            <label for="status">Status*</label>
                            <div class="form-check">
                                <input class="form-control" type="hidden" name="status" value="false">
                                <input class="form-check-input" type="checkbox" dusk="checkboxEventTypes" id="status" name="status" {{(is_null(old('status')) ? (formMode() == 'create' ? true : $eventType->status) : old('status')) ? 'checked="checked"' : ''}} @include('partials.disabled', ['model'=>$eventType, 'permission'=>'event-types:store'])>
                                <label class="form-check-label" for="status">Ativo</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
