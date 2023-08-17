@extends('layouts.app')

@section('content')
    <div class="py-4 px-4">
        <form name="formulario" id="formulario" @if(formMode() == 'show') action="{{ route('routines.update', ['id' => $routine->id]) }}" @else action="{{ route('routines.store')}}" @endIf method="POST">
            @csrf

            @if (isset($routine))
                <input type="hidden" name="id" value="{{ $routine->id }}">
            @endif

            <div class="">
                <div class="row">
                    <div class="col-sm-8 align-self-center">
                        <h3 class="mb-0">
                            <a href="{{ route('routines.index') }}">Rotinas</a>

                            @if(is_null($routine->id))
                                > Nova
                            @else
                                > {{ $routine->code }}
                            @endif

                        </h3>
                        @if (!Route::is('routines.create') )
                            @if ($routine['status'])
                                <label class="badge bg-success"> ABERTA </label>
                            @else
                                <label class="badge bg-danger"> FINALIZADA </label>
                            @endif
                        @endif
                    </div>
                    <div class="col-sm-4 align-self-center d-flex justify-content-end gap-4">
                        @include('partials.save-button', ['model'=>$routine, 'backUrl' => 'routines.index', 'permission'=>($routine->status ? (formMode() == 'show' ? 'routines:update' : 'routines:store') : ''), 'id' => $routine->id])
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
                            <label for="shift_id">Turno*</label>
                            <select class="form-select" name="shift_id" id="shift_id" @disabled(!$routine->status)>
                                <option value="">SELECIONE</option>
                                @foreach ($shifts as $key => $shift)
                                    @if(((!is_null($routine->id)) && (!is_null($routine->shift_id) && $routine->shift_id === $shift->id) || (!is_null(old('shift_id'))) && old('shift_id') == $shift->id))
                                        <option value="{{ $shift->id }}" selected="selected">{{ $shift->name }}</option>
                                    @else
                                        <option value="{{ $shift->id }}">{{ $shift->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="entranced_at">Data (Assunção)*</label>
                                @if (Route::is('routines.create') )
                                    <input type="datetime-local" max="3000-01-01T23:59" class="form-control" name="entranced_at" id="entranced_at" value="{{date('Y-m-d H:i')}}"/>
                                @else
                                    <input type="datetime-local" max="3000-01-01T23:59" class="form-control" name="entranced_at" id="entranced_at" value="{{is_null(old('entranced_at')) ? $routine->entranced_at_formatted : old('entranced_at')}}" @disabled(!$routine->status)/>
                                @endif
                        </div>
                        <div class="form-group">
                            <label for="entranced_user_id">Responsável (Assunção)*</label>
                            <select class="select2" name="entranced_user_id" id="entranced_user_id" @disabled(!$routine->status)>
                                <option value="">SELECIONE</option>
                                @foreach ($entrancedUsers as $key => $user)
                                    @if(((!is_null($routine->id)) && (!is_null($routine->entranced_user_id) && $routine->entranced_user_id === $user->id) || (!is_null(old('entranced_user_id'))) && old('entranced_user_id') == $user->id))
                                        <option value="{{ $user->id }}" selected="selected">{{ $user->name }}</option>
                                    @else
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="entranced_obs">Observações (Assunção)</label>
                            <textarea class="form-control" name="entranced_obs" id="entranced_obs" @disabled(!$routine->status)>{{ is_null(old('entranced_obs')) ? $routine->entranced_obs : old('entranced_obs') }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="checkpoint_obs">Carga*</label>
                            <input class="form-control" name="checkpoint_obs" id="checkpoint_obs" value="{{is_null(old('checkpoint_obs')) ? $routine->checkpoint_obs : old('checkpoint_obs')}}" @disabled(!$routine->status)/>
                        </div>
                        <div class="form-group">
                            <label for="exited_at">Data (Passagem)</label>
                            <input type="datetime-local" max="3000-01-01T23:59" class="form-control text-uppercase" name="exited_at" id="exited_at" value="{{is_null(old('exited_at')) ? $routine->exited_at_formatted : old('exited_at')}}" @disabled(!$routine->status)/>
                        </div>
                        <div class="form-group">
                            <label for="exited_user_id">Responsável (Passagem)</label>
                            <select class="select2" name="exited_user_id" id="exited_user_id" @disabled(!$routine->status)>
                                <option value="">SELECIONE</option>
                                @foreach ($exitedUsers as $key => $user)
                                    @if(((!is_null($routine->id)) && (!is_null($routine->exited_user_id) && $routine->exited_user_id === $user->id) || (!is_null(old('exited_user_id'))) && old('exited_user_id') == $user->id))
                                        <option value="{{ $user->id }}" selected="selected">{{ $user->name }}</option>
                                    @else
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exited_obs">Observações (Passagem)</label>
                            <textarea class="form-control" name="exited_obs" id="exited_obs" @disabled(!$routine->status)>{{ is_null(old('exited_obs')) ? $routine->exited_obs : old('exited_obs') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        @if(formMode() == 'show')
            @include('events.partials.table',['events'=>$routine->events, 'routine_id' => $routine->id, 'redirect' => 'routines.show'])

            @include('stuffs.partials.table',['stuffs'=>$routine->stuffs, 'routine_id' => $routine->id, 'redirect' => 'routines.show'])

            @include('cautions.partials.table',['cautions'=>$routine->cautions, 'routine_id' => $routine->id, 'redirect' => 'routines.show'])
        @endIf
    </div>

    @include('partials.button-to-top')

@endsection
