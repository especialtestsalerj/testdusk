@extends('layouts.app')

@section('content')
    <div class="card card-default mx-0 my-0 mx-lg-5 my-lg-4">
        <form name="formulario" id="formulario" @if(formMode() == 'show') action="{{ route('events.updateFromDashboard', ['routine_id' => $routine_id, 'id' => $event->id]) }}" @else action="{{ route('events.storeFromDashboard', ['routine_id' => $routine_id])}}" @endIf method="POST">
            @csrf

            @if (isset($event))
                <input name="id" type="hidden" value="{{ $event->id }}">
            @endif
            <input name="routine_id" type="hidden" value="{{ $routine_id }}">

            <div class="card-header py-4 px-4">
                <div class="row">
                    <div class="col-sm-8 align-self-center">
                        <h4 class="mb-0">
                            <a href="{{ route('events.index', ['routine_id' => $routine_id]) }}">Ocorrências</a>

                            @if(is_null($event->id))
                                > Nova
                            @else
                                > {{ $event->id }} - {{ $event->occurred_at->format('d/m/Y \À\S H:i') }}
                            @endif
                        </h4>
                    </div>

                    <div class="col-sm-4 align-self-center d-flex justify-content-end">
                        @include('partials.save-button', ['model'=>$event, 'backUrl' => 'events.index', 'permission'=>($routine->status && !request()->query('disabled') ?
 'events:update' : ''), 'id' =>$routine_id])
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
                            <label for="event_type_id">Tipo*</label>
                            <select class="select2" name="event_type_id" id="event_type_id" value="{{is_null(old('event_type_id')) ? $event->event_type_id : old('event_type_id')}}" @disabled(!$routine->status) @if(request()->query('disabled')) disabled @endif>
                                <option value="">SELECIONE</option>
                                @foreach ($eventTypes as $key => $eventType)
                                    @if(((!is_null($event->id)) && (!is_null($event->event_type_id) && $event->event_type_id === $eventType->id) || (!is_null(old('event_type_id'))) && old('event_type_id') == $eventType->id))
                                        <option value="{{ $eventType->id }}" selected="selected">{{ $eventType->name }}</option>
                                    @else
                                        <option value="{{ $eventType->id }}">{{ $eventType->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="occurred_at">Data da Ocorrência*</label>
                            <input type="datetime-local" max="3000-01-01T23:59" class="form-control text-uppercase" name="occurred_at" id="occurred_at" value="{{is_null(old('occurred_at')) ? (formMode() == 'create' ? $routine->entranced_at->format('Y-m-d ').date('H:i') : $event->occurred_at_formatted) : old('occurred_at')}}" @disabled(!$routine->status) @if(request()->query('disabled')) disabled @endif/>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="sector_id">Setor</label>
                            <select class="select2 form-control" name="sector_id" id="sector_id" value="{{is_null(old('sector_id')) ? $event->sector_id : old('sector_id')}}" @disabled(!$routine->status) @if(request()->query('disabled')) disabled @endif>
                                <option value=""></option>
                                @foreach ($sectors as $key => $sector)
                                    @if(((!is_null($event->id)) && (!is_null($event->sector_id) && $event->sector_id === $sector->id) || (!is_null(old('sector_id'))) && old('sector_id') == $sector->id))
                                        <option value="{{ $sector->id }}" selected="selected">{{ $sector->name }}</option>
                                    @else
                                        <option value="{{ $sector->id }}">{{ $sector->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="duty_user_id">Plantonista*</label>
                            <select class="select2 form-control" name="duty_user_id" id="duty_user_id" @disabled(!$routine->status) @if(request()->query('disabled')) disabled @endif>
                                <option value="">SELECIONE</option>
                                @foreach ($users as $key => $user)
                                    @if(((!is_null($event->id)) && (!is_null($event->duty_user_id) && $event->duty_user_id === $user->id) || (!is_null(old('duty_user_id'))) && old('duty_user_id') == $user->id))
                                        <option value="{{ $user->id }}" selected="selected">{{ $user->name }}</option>
                                    @else
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="description">Observações*</label>
                            <textarea class="form-control" name="description" id="description" @disabled(!$routine->status) @if(request()->query('disabled')) disabled @endif>{{is_null(old('description')) ? $event->description: old('description')}}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="text-center py-4">
        <a href="{{ url('/dashboard') }}" title="Ir para a Home">Home</a>
    </div>
@endsection
