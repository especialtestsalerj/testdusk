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
                                > {{ $event->id }} - {{ $event->occurred_at_formatted }}
                            @endif
                        </h4>
                    </div>

                    <div class="col-sm-4 align-self-center d-flex justify-content-end">
                        @include('partials.save-button', ['model'=>$event, 'backUrl' => 'routines.show', 'permission'=>'events:store','id' =>$routine_id])
                    </div>
                </div>
            </div>

            <div class="card-body">
                @if ($errors->has('name'))
                    <div class="alert alert-danger" role="alert">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                @if ($errors->has('status'))
                    <div class="alert alert-danger" role="alert">
                        {{ $errors->first('status') }}
                    </div>
                @endif

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="event_type_id">Tipo</label>
                            <select class="form-control select2" name="event_type_id" id="event_type_id" value="{{is_null(old('event_type_id')) ? $event->event_type_id : old('event_type_id')}}">
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
                            <label for="occurred_at">Data da Ocorrência</label>
                            <input type="datetime-local" max="1900-01-01T23:59" class="form-control" name="occurred_at" id="occurred_at" value="{{is_null(old('occurred_at')) ? $event->occurred_at_formatted: old('occurred_at')}}"/>
                        </div>
                        <div class="form-group">
                            <label for="duty_user_id">Plantonista</label>
                            <select class="form-control select2" name="duty_user_id" id="duty_user_id" value="{{is_null(old('duty_user_id')) ? $event->duty_user_id : old('duty_user_id')}}">
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
                            <label for="description">Observações</label>
                            <textarea class="form-control" name="description" id="description">{{is_null(old('description')) ? $event->description: old('description')}}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
