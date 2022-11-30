@extends('layouts.app')

@section('content')
    <div class="card card-default" id="vue-events">
        <form name="formulario" id="formulario" @if(formMode() == 'show') action="{{ route('events.update', ['id' => $event->id]) }}" @else action="{{ route('events.store')}}" @endIf method="POST">
            @csrf

            @if (isset($event))
                <input name="id" type="hidden" value="{{ $event->id }}">
            @endif
            <input name="routine_id" type="hidden" value="{{ $routine_id }}">

            <div class="card-header">
                <div class="row">
                    <div class="col-sm-8 align-self-center">
                        <h4 class="mb-0">
                            <a href="{{ route('routines.show', ['id' => $routine_id]) }}">Ocorrências</a>

                            @if(is_null($event->id))
                                > Nova
                            @else
                                > {{ $event->id }} - {{ $event->occurred_at->format('d/m/Y \À\S H:i') }}
                            @endif
                        </h4>
                    </div>

                    <div class="col-sm-4 align-self-center d-flex justify-content-end">
                        <span class="required-msg">* Campos obrigatórios</span>
                        @include('partials.save-button', ['model'=>$event, 'backUrl' => 'routines.show', 'permission'=>($routine->status ? 'events:update' : ''), 'id' =>$routine_id])
                    </div>
                </div>
            </div>

            <div class="card-body">
                @include('layouts.msg')

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="event_type_id">Tipo*</label>
                            <select class="select2" name="event_type_id" id="event_type_id" value="{{is_null(old('event_type_id')) ? $event->event_type_id : old('event_type_id')}}" @disabled(!$routine->status)>
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
                        <div class="form-group">
                            <label for="occurred_at">Data da Ocorrência*</label>
                            <input type="datetime-local" max="3000-01-01T23:59" class="form-control text-uppercase" name="occurred_at" id="occurred_at" value="{{is_null(old('occurred_at')) ? (formMode() == 'create' ? $routine->entranced_at->format('Y-m-d ').date('H:i') : $event->occurred_at_formatted) : old('occurred_at')}}" @disabled(!$routine->status)/>
                        </div>
                        <div class="form-group">
                            <label for="sector_id">Setor</label>
                            <select class="select2" name="sector_id" id="sector_id" value="{{is_null(old('sector_id')) ? $event->sector_id : old('sector_id')}}" @disabled(!$routine->status)>
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
                            <select class="select2" name="duty_user_id" id="duty_user_id" @disabled(!$routine->status)>
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
                            <textarea class="form-control" name="description" id="description" @disabled(!$routine->status)>{{is_null(old('description')) ? $event->description: old('description')}}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
