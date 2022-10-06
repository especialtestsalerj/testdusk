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
                        <span class="required-msg">* Campos obrigatórios</span>
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
                            <label for="started_at">Entrada*</label>
                            <input type="datetime-local" max="3000-01-01T23:59" class="form-control text-uppercase" name="started_at" id="started_at" value="{{is_null(old('started_at')) ? (formMode() == 'create' ? $routine->entranced_at : $caution->started_at_formatted) : old('started_at')}}"/>
                        </div>
                        <div class="form-group">
                            <label for="concluded_at">Saída</label>
                            <input type="datetime-local" max="3000-01-01T23:59" class="form-control text-uppercase" name="concluded_at" id="concluded_at" value="{{is_null(old('concluded_at')) ? $caution->concluded_at_formatted: old('exited_at')}}"/>
                        </div>
                        @livewire('people.people', ['person' => $caution->person, 'mode' => formMode()])
                        <div class="form-group">
                            <label for="destiny_sector_id">Destino*</label>
                            <select class="form-select" name="destiny_sector_id" id="destiny_sector_id" value="{{is_null(old('destiny_sector_id')) ? $caution->destiny_sector_id : old('destiny_sector_id')}}">
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
                            <select class="form-select" name="duty_user_id" id="duty_user_id" value="{{is_null(old('duty_user_id')) ? $caution->duty_user_id : old('duty_user_id')}}">
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
                            <textarea class="form-control" name="description" id="description">{{is_null(old('description')) ? $caution->description: old('description')}}</textarea>
                        </div>
                    </div>
                </div>
                @if (formMode() == 'show')
                    <div class="p-4 bg-light border rounded-3">
                        <h5>
                            <i class="fas fa-gun"></i> Armas
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#weaponModal" title="Nova Arma">
                                <i class="fa fa-plus"></i>
                            </button>
                        </h5>
                    </div>
                @else
                    <div class="alert alert-warning mt-2">
                        <i class="fa fa-exclamation-triangle"></i> Para adicionar armas, salve primeiramente o cadastro da cautela.
                    </div>
                @endif
            </div>
        </form>
        <!-- Modal -->
        <div class="modal fade" id="weaponModal" tabindex="-1" aria-labelledby="weaponModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="weaponModalLabel"><i class="fas fa-gun"></i> {{1==2 ? 'Alterar' : 'Nova'}} Arma</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <livewire:caution-weapons.create-form />
                </div>
            </div>
        </div>
    </div>
@endsection
