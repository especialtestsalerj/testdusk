@extends('layouts.app')

@section('content')


    <div class="py-4 px-4">
        <form name="formulario" id="formulario" @if(formMode() == 'show') action="{{ route('visitors.update', ['id' => $visitor->id]) }}" @else action="{{ route('visitors.store')}}" @endIf method="POST">
            @csrf

            @if (isset($visitor))
                <input type="hidden" name="id" value="{{ $visitor->id }}">
            @endif

            <input type="hidden" name="redirect" value="{{ request()->query('redirect') }}">

            <div class="">
                <div class="row">
                    <div class="col-sm-8 align-self-center">
                        <h4 class="mb-0">
                            @if(is_null($visitor->id))
{{--                                <a href="{{ route(request()->query('redirect'))  }}">Visitantes</a>--}}
                                > Novo/a
                            @else
                                <a href="{{ route(request()->query('redirect')) }}">Visitantes</a>
                                > {{ $visitor->id }} - {{ $visitor->entranced_at->format('d/m/Y \À\S H:i') }}
                            @endif
                        </h4>
                        @if($visitor->hasPending())
                            <span class="badge bg-warning text-black"><i class="fa fa-exclamation-triangle"></i> ROTINA ANTERIOR </span>
                        @endif
                    </div>

                    <div class="col-sm-4 align-self-center d-flex justify-content-end gap-4">

                        @include('partials.save-button',
                                ['model' => $visitor, 'backUrl' => 'visitors.create',
                                'permission' => (formMode() == 'show' ? 'visitors:update' : 'visitors:store')])
                    </div>
                </div>
            </div>

            <div class="card-body my-2">
                @include('layouts.msg')
                <div class="row">
                    <div class="col-12 d-flex justify-content-end">
                        <span class="badge bg-warning text-black required-msg"><i class="fa fa-circle-info"></i> * Campos obrigatórios </span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="entranced_at">Entrada*</label>
                            <input type="datetime-local" max="3000-01-01T23:59" class="form-control text-uppercase" name="entranced_at" id="entranced_at" value="{{ is_null(old('occurred_at')) ? (formMode() == 'create' ? date('Y-m-d H:i') : $visitor->entranced_at_formatted) : old('occurred_at') }}" @disabled(request()->query('disabled')) @if($visitor->hasPending()) readonly @endif/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exited_at">Saída</label>
                            <input type="datetime-local" max="3000-01-01T23:59" class="form-control text-uppercase" name="exited_at" id="exited_at" value="{{ is_null(old('exited_at')) ? $visitor->exited_at_formatted: old('exited_at') }}" @disabled(request()->query('disabled')) />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        @livewire('people.people', ['person' => $visitor->person, 'routineStatus' => (null), 'mode' => formMode(), 'modal' => request()->query('disabled'), 'readonly' => $visitor->hasPending(), 'showRestrictions' => true])
                        <div class="form-group">
                            <label for="sector_id">Destino*</label>
                            <select class="select2 form-control" name="sector_id" id="sector_id" @disabled(request()->query('disabled')) @if($visitor->hasPending()) readonly @endif>
                                <option value=""></option>
                                @foreach ($sectors as $key => $sector)
                                    @if(((!is_null($visitor->id)) && (!is_null($visitor->sector_id) && $visitor->sector_id === $sector->id) || (!is_null(old('sector_id'))) && old('sector_id') == $sector->id))
                                        <option value="{{ $sector->id }}" selected="selected">{{ $sector->name }}</option>
                                    @else
                                        <option value="{{ $sector->id }}">{{ $sector->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="description">Motivo Visita*</label>
                            <textarea class="form-control" name="description" id="description" @disabled(request()->query('disabled')) >{{ is_null(old('description')) ? $visitor->description: old('description') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
