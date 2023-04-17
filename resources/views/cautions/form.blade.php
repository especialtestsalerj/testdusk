@extends('layouts.app')

@section('content')
    <div class="py-4 px-4">
        <form name="formulario" id="formulario" @if(formMode() == 'show') action="{{ route('cautions.update', ['routine_id' => $routine_id, 'id' => $caution->id]) }}" @else action="{{ route('cautions.store', ['routine_id' => $routine_id])}}" @endIf method="POST">
            @csrf

            @if (isset($caution))
                <input type="hidden" name="id" value="{{ $caution->id }}">
            @endif
            <input type="hidden" name="routine_id" value="{{ $routine_id }}">
            <input type="hidden" name="redirect" value="{{ request()->query('redirect') }}">

            <div class="card-header">
                <div class="row">
                    <div class="col-sm-8 align-self-center">
                        <h4 class="mb-0">
                            @if(is_null($caution->id))
                                <a href="{{ route(request()->query('redirect'), ['routine_id' => $routine_id, 'id' => $routine_id]) }}">Cautelas de Armas</a>
                                > Nova
                            @else
                                <a href="{{ route(request()->query('redirect'), ['routine_id' => $routine_id, 'id' => $caution->id]) }}">Cautelas de Armas</a>
                                > {{ $caution->id }} - {{ $caution?->protocol_number_formatted }}
                            @endif
                        </h4>
                        @if(!is_null($caution->id))
                            @if(!$caution->hasWeapons())
                                <span class="badge bg-danger text-white"><i class="fa fa-exclamation-triangle"></i> SEM ARMA(S) </span>
                            @endif
                        @endif
                        @if($caution->hasPending())
                            <span class="badge bg-warning text-black"><i class="fa fa-exclamation-triangle"></i> ROTINA ANTERIOR </span>
                        @endif
                    </div>

                    <div class="col-sm-4 align-self-center d-flex justify-content-end gap-4">
                        @include('partials.save-button', ['model' => $caution, 'backUrl' => request()->query('redirect'), 'permission'=>($routine->status && !request()->query('disabled') ? (formMode() == 'show' ? 'cautions:update' : 'cautions:store') : ''), 'id' =>$routine_id])
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
                            <label for="started_at">Abertura*</label>
                            <input type="datetime-local" max="3000-01-01T23:59" class="form-control text-uppercase" name="started_at" id="started_at" value="{{ is_null(old('started_at')) ? (formMode() == 'create' ? $routine->entranced_at : $caution->started_at_formatted) : old('started_at') }}" @if(!$routine->status || request()->query('disabled')) disabled @endif @if($caution->hasPending()) readonly @endif/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="concluded_at">Fechamento</label>
                            <input type="datetime-local" max="3000-01-01T23:59" class="form-control text-uppercase" name="concluded_at" id="concluded_at" value="{{ is_null(old('concluded_at')) ? $caution->concluded_at_formatted : old('concluded_at') }}" @if(!$routine->status || request()->query('disabled')) disabled @endif/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @livewire('visitors.people', ['routine_id' => $routine_id, 'visitor_id' => $caution?->visitor?->id, 'routineStatus' => $routine->status, 'mode' => formMode(), 'modal' => request()->query('disabled'), 'readonly' => $caution->hasPending()])
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="duty_user_id">Plantonista*</label>
                            <select class="select2 form-control" name="duty_user_id" id="duty_user_id" @if(!$routine->status || request()->query('disabled')) disabled @endif>
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
                        <div class="form-group">
                            <label for="description">Observações</label>
                            <textarea class="form-control" name="description" id="description" @if(!$routine->status || request()->query('disabled')) disabled @endif>{{ is_null(old('description')) ? $caution->description: old('description') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        @if (formMode() == 'show')
            <div class="p-4 bg-light border rounded-3">
                <livewire:caution-weapons.index-form :caution_id="$caution->id" :cautionWeapons="$cautionWeapons" :routine="$routine" :disabled="(!$routine->status || request()->query('disabled'))" />
            </div>
        @else
            <div class="alert alert-warning mt-2">
                <i class="fa fa-exclamation-triangle"></i> Para adicionar armas, salve primeiramente o cadastro da cautela.
            </div>
        @endif
    </div>
@endsection
