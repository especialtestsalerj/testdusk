@extends('layouts.app')

@section('content')
    <div class="card card-default" id="vue-cautions">
        <form name="formulario" id="formulario" @if(formMode() == 'show') action="{{ route('cautions.update', ['id' => $caution->id]) }}" @else action="{{ route('cautions.store')}}" @endIf method="POST">
            @csrf

            @if (isset($caution))
                <input name="id" type="hidden" value="{{ $caution->id }}">
            @endif
            <input name="routine_id" type="hidden" value="{{ $routine_id }}">

            <div class="card-header">
                <div class="row">
                    <div class="col-sm-8 align-self-center">
                        <h4 class="mb-0">
                            <a href="{{ route('routines.show', ['id' => $routine_id]) }}">Cautelas de Armas</a>

                            @if(is_null($caution->id))
                                > Novo/a
                            @else
                                > {{ $caution->id }} - {{ $caution->started_at->format('d/m/Y \À\S H:i') }}
                            @endif
                        </h4>
                    </div>

                    <div class="col-sm-4 align-self-center d-flex justify-content-end">
                        @include('partials.save-button', ['model'=>$caution, 'backUrl' => 'routines.show', 'permission'=>'cautions:store','id' =>$routine_id])
                    </div>
                </div>
            </div>

            <div class="card-body">
                @include('layouts.msg')
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
                            <label for="started_at">Entrada</label>
                            <input type="datetime-local" max="3000-01-01T23:59" class="form-control text-uppercase" name="started_at" id="started_at" value="{{is_null(old('occurred_at')) ? (formMode() == 'create' ? $routine->entranced_at : $event->occurred_at_formatted) : old('occurred_at')}}"/>
                        </div>
                        <div class="form-group">
                            <label for="concluded_at">Saída</label>
                            <input type="datetime-local" max="3000-01-01T23:59" class="form-control text-uppercase" name="concluded_at" id="concluded_at" value="{{is_null(old('concluded_at')) ? $caution->concluded_at_formatted: old('exited_at')}}"/>
                        </div>
                        <div class="form-group">
                            <label for="person_id">Visitante</label>
                            <select class="form-control select2" name="person_id" id="person_id" value="{{is_null(old('person_id')) ? $caution->person_id : old('person_id')}}">
                                <option value="">SELECIONE</option>
                                @foreach ($people as $key => $person)
                                    @if(((!is_null($caution->id)) && (!is_null($caution->person_id) && $caution->person_id === $person->id) || (!is_null(old('person_id'))) && old('person_id') == $person->id))
                                        <option value="{{ $person->id }}" selected="selected">{{ $person->full_name }}</option>
                                    @else
                                        <option value="{{ $person->id }}">{{ $person->full_name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="destiny_sector_id">Setor</label>
                            <select class="form-control select2" name="destiny_sector_id" id="destiny_sector_id" value="{{is_null(old('destiny_sector_id')) ? $caution->destiny_sector_id : old('destiny_sector_id')}}">
                                <option value="">SELECIONE</option>
                                @foreach ($sectors as $key => $sector)
                                    @if(((!is_null($caution->id)) && (!is_null($caution->destiny_sector_id) && $caution->destiny_sector_id === $sector->id) || (!is_null(old('destiny_sector_id'))) && old('destiny_sector_id') == $sector->id))
                                        <option value="{{ $sector->id }}" selected="selected">{{ $sector->name }}</option>
                                    @else
                                        <option value="{{ $sector->id }}">{{ $sector->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="duty_user_id">Plantonista</label>
                            <select class="form-control select2" name="duty_user_id" id="duty_user_id" value="{{is_null(old('duty_user_id')) ? $caution->duty_user_id : old('duty_user_id')}}">
                                <option value="">SELECIONE</option>
                                @foreach ($users as $key => $user)
                                    @if(((!is_null($caution->id)) && (!is_null($caution->duty_user_id) && $caution->duty_user_id === $user->id) || (!is_null(old('duty_user_id'))) && old('duty_user_id') == $user->id))
                                        <option value="{{ $user->id }}" selected="selected">{{ $user->name }}</option>
                                    @else
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
