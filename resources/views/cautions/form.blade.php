@extends('layouts.app')

@section('content')
    <div class="card card-default mx-0 my-0 mx-lg-5 my-lg-4">
        <form name="formulario" id="formulario" @if(formMode() == 'show') action="{{ route('cautions.update', ['routine_id' => $routine_id, 'id' => $caution->id]) }}" @else action="{{ route('cautions.store', ['routine_id' => $routine_id])}}" @endIf method="POST">
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
                                > {{ $caution->id }} - {{ $caution?->protocol_number_formatted }}
                            @endif
                        </h4>
                    </div>

                    <div class="col-sm-4 align-self-center d-flex justify-content-end">
                        @include('partials.save-button', ['model'=>$caution, 'backUrl' => 'routines.show', 'permission'=>($routine->status && !request()->query('disabled') ? 'cautions:update' : ''), 'id' =>$routine_id])
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
                @if (session('message'))
                    <div class="alert alert-success">
                        <i class="fa fa-check-circle"></i> {{ session('message') }}
                    </div>
                @endif
                <div class="row">
                    <div class="col-12 d-flex justify-content-end">
                        <span class="badge bg-warning text-black required-msg">* Campos obrigatórios </span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="started_at">Abertura*</label>
                            <input type="datetime-local" max="3000-01-01T23:59" class="form-control text-uppercase" name="started_at" id="started_at" value="{{ is_null(old('started_at')) ? (formMode() == 'create' ? $routine->entranced_at : $caution->started_at_formatted) : old('started_at') }}" @disabled(!$routine->status) @if(request()->query('disabled')) disabled @endif/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="concluded_at">Fechamento</label>
                            <input type="datetime-local" max="3000-01-01T23:59" class="form-control text-uppercase" name="concluded_at" id="concluded_at" value="{{ is_null(old('concluded_at')) ? $caution->concluded_at_formatted : old('concluded_at') }}" @disabled(!$routine->status) @if(request()->query('disabled')) disabled @endif/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @livewire('visitors.people', ['routine_id' => $routine_id, 'visitor_id' => $caution?->visitor?->id, 'routineStatus' => $routine->status, 'mode' => formMode()])
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="destiny_sector_id">Destino*</label>
                            <select class="select2 form-control" name="destiny_sector_id" id="destiny_sector_id" @disabled(!$routine->status) @if(request()->query('disabled')) disabled @endif>
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
                            <label for="duty_user_id">Plantonista*</label>
                            <select class="select2 form-control" name="duty_user_id" id="duty_user_id" @disabled(!$routine->status) @if(request()->query('disabled')) disabled @endif>
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
                            <textarea class="form-control" name="description" id="description" @disabled(!$routine->status) @if(request()->query('disabled')) disabled @endif>{{ is_null(old('description')) ? $caution->description: old('description') }}</textarea>
                        </div>
                    </div>
                </div>
                @if (formMode() == 'show')
                    <div class="p-4 bg-light border rounded-3">
                        @include('caution-weapons.partials.table', ['cautionWeapons' => $cautionWeapons, 'routineStatus' => $routine->status])
                    </div>
                @else
                    <div class="alert alert-warning mt-2">
                        <i class="fa fa-exclamation-triangle"></i> Para adicionar armas, salve primeiramente o cadastro da cautela.
                    </div>
                @endif
            </div>
        </form>
        <!-- Modal -->
        <div wire:ignore.self class="modal fade" id="weapon-modal" tabindex="-1" role="dialog" aria-labelledby="weaponModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="weaponModalLabel"><i class="fas fa-gun"></i> Nova Arma</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <livewire:caution-weapons.index-form :caution="$caution" :readonly="request()->query('disabled')"/>
                </div>
            </div>
        </div>
    </div>
@endsection
