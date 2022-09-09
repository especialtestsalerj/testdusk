@extends('layouts.app')

@section('content')
    <div class="card card-default">
        <form name="formulario" id="formulario" @if(formMode() == 'show') action="{{ route('event_types.update', ['id' => $eventType->id]) }}" @else action="{{ route('event_types.store')}}" @endIf method="POST">
            {{ csrf_field() }}
            <input name="id" type="hidden" value="{{$eventType->id}}" id="id" >

            <div class="card-header">
                <div class="row">
                    <div class="col-sm-8 align-self-center">
                        <h2 class="mb-0">
                            <a href="{{ route('event_types.index') }}">Tipos de Ocorrência</a>

                            @if(is_null($eventType->id))
                                > Novo
                            @else
                                > {{ $eventType->id }} - {{ $eventType->name }}
                            @endif
                        </h2>
                    </div>

                    <div class="col-sm-4 align-self-center d-flex justify-content-end">
                        @include('partials.save-button', ['model'=>$eventType, 'backUrl' => 'event_types.index', 'permission'=>'event_types:store'])
                    </div>
                </div>
            </div>

            <div class="card-body">
                @include('layouts.msg')

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="name">Nome</label>
                            <input class="form-control" id="name" name="name" value="{{is_null(old('name')) ? $eventType->name : old('name')}}" @include('partials.disabled', ['model'=>$eventType, 'permission'=>'event_types:store'])/>
                        </div>

                        <div class="form-group">
                            <label for="status">Status</label>
                            <div class="form-check">
                                <input class="form-control" type="hidden" name="status" value="false">
                                <input class="form-check-input" type="checkbox" id="status" name="status" {{(is_null(old('status')) ? (formMode() == 'create' ? true : $eventType->status) : old('status')) ? 'checked="checked"' : ''}} @include('partials.disabled', ['model'=>$eventType, 'permission'=>'event_types:store'])>
                                <label class="form-check-label" for="status">Ativo</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
