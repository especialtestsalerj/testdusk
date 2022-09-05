@extends('layouts.app')

@section('content')
    <div class="card card-default" id="vue-stuffs">
        <form name="formulario" id="formulario" @if(formMode() == 'show') action="{{ route('stuffs.update', ['id' => $stuff->id]) }}" @else action="{{ route('stuffs.store')}}" @endIf method="POST">
            @csrf

            @if (isset($stuff))
                <input name="id" type="hidden" value="{{ $stuff->id }}">
            @endif
            <input name="routine_id" type="hidden" value="{{ $routine_id }}">

            <div class="card-header">
                <div class="row">
                    <div class="col-sm-8 align-self-center">
                        <h4 class="mb-0">
                            <a href="{{ route('routines.show', ['id' => $routine_id]) }}">Materiais</a>

                            @if(is_null($stuff->id))
                                > Novo
                            @else
                                > {{ $stuff->id }} - {{ $stuff->entranced_at_formatted }}
                            @endif
                        </h4>
                    </div>

                    <div class="col-sm-4 align-self-center d-flex justify-content-end">
                        @include('partials.save-button', ['model'=>$stuff, 'backUrl' => 'routines.show', 'permission'=>'stuffs:store','id' =>$routine_id])
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
                            <label for="entranced_at">Entrada</label>
                            <input type="datetime-local" max="1900-01-01T23:59" class="form-control" name="entranced_at" id="entranced_at" value="{{is_null(old('entranced_at')) ? $stuff->entranced_at_formatted: old('entranced_at')}}"/>
                        </div>
                        <div class="form-group">
                            <label for="exited_at">Saída</label>
                            <input type="datetime-local" max="1900-01-01T23:59" class="form-control" name="exited_at" id="exited_at" value="{{is_null(old('exited_at')) ? $stuff->exited_at_formatted: old('exited_at')}}"/>
                        </div>
                        <div class="form-group">
                            <label for="duty_user_id">Plantonista</label>
                            <select class="form-control select2" name="duty_user_id" id="duty_user_id" value="{{is_null(old('duty_user_id')) ? $stuff->duty_user_id : old('duty_user_id')}}">
                                <option value="">SELECIONE</option>
                                @foreach ($users as $key => $user)
                                    @if(((!is_null($stuff->id)) && (!is_null($stuff->duty_user_id) && $stuff->duty_user_id === $user->id) || (!is_null(old('duty_user_id'))) && old('duty_user_id') == $user->id))
                                        <option value="{{ $user->id }}" selected="selected">{{ $user->name }}</option>
                                    @else
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="description">Observações</label>
                            <textarea class="form-control" name="description" id="description">{{is_null(old('description')) ? $stuff->description: old('description')}}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
