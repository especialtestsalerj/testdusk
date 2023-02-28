@extends('layouts.app')

@section('content')
    <div class="card card-default">
        <form name="formulario" id="formulario" @if(formMode() == 'show') action="{{ route('stuffs.updateFromDashboard', ['routine_id' => $routine_id, 'id' => $stuff->id]) }}" @else action="{{ route('stuffs.storeFromDashboard', ['routine_id' => $routine_id])}}" @endIf method="POST">
            @csrf

            @if (isset($stuff))
                <input name="id" type="hidden" value="{{ $stuff->id }}">
            @endif
            <input name="routine_id" type="hidden" value="{{ $routine_id }}">

            <div class="card-header">
                <div class="row">
                    <div class="col-sm-8 align-self-center">
                        <h2 class="mb-0">
                            <a href="{{ route('stuffs.index', ['routine_id' => $routine_id]) }}">Materiais</a>

                            @if(is_null($stuff->id))
                                > Novo
                            @else
                                > {{ $stuff->id }} - {{ $stuff->entranced_at->format('d/m/Y \À\S H:i') }}
                            @endif
                        </h2>
                    </div>

                    <div class="col-sm-4 align-self-center d-flex justify-content-end">
                        <span class="required-msg">* Campos obrigatórios</span>
                        @include('partials.save-button', ['model'=>$stuff, 'backUrl' => 'stuffs.index', 'permission'=>($routine->status && !request()->query('disabled') ? 'stuffs:update' : ''), 'id' =>$routine_id])
                    </div>
                </div>
            </div>

            <div class="card-body">
                @include('layouts.msg')

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="entranced_at">Entrada*</label>
                            <input type="datetime-local" max="3000-01-01T23:59" class="form-control text-uppercase" name="entranced_at" id="entranced_at" value="{{is_null(old('occurred_at')) ? (formMode() == 'create' ? $routine->entranced_at->format('Y-m-d ').date('H:i') : $stuff->entranced_at_formatted) : old('occurred_at')}}" @disabled(!$routine->status) @if(request()->query('disabled')) disabled @endif/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exited_at">Saída</label>
                            <input type="datetime-local" max="3000-01-01T23:59" class="form-control text-uppercase" name="exited_at" id="exited_at" value="{{is_null(old('exited_at')) ? $stuff->exited_at_formatted: old('exited_at')}}" @disabled(!$routine->status) @if(request()->query('disabled')) disabled @endif/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="sector_id">Setor</label>
                            <select class="select2 form-control" name="sector_id" id="sector_id" @disabled(!$routine->status) @if(request()->query('disabled')) disabled @endif>
                                <option value=""></option>
                                @foreach ($sectors as $key => $sector)
                                    @if(((!is_null($stuff->id)) && (!is_null($stuff->sector_id) && $stuff->sector_id === $sector->id) || (!is_null(old('sector_id'))) && old('sector_id') == $sector->id))
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
                                    @if(((!is_null($stuff->id)) && (!is_null($stuff->duty_user_id) && $stuff->duty_user_id === $user->id) || (!is_null(old('duty_user_id'))) && old('duty_user_id') == $user->id))
                                        <option value="{{ $user->id }}" selected="selected">{{ $user->name }}</option>
                                    @else
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="description">Observações*</label>
                            <textarea class="form-control" name="description" id="description" @disabled(!$routine->status) @if(request()->query('disabled')) disabled @endif>{{is_null(old('description')) ? $stuff->description: old('description')}}</textarea>
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
