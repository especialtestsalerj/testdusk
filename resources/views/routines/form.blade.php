@extends('layouts.app')

@section('content')
    <div class="card card-default mx-5 my-4" id="vue-routines">
        <form name="formulario" id="formulario" @if(formMode() == 'show') action="{{ route('routines.update', ['id' => $routine->id]) }}" @else action="{{ route('routines.store')}}" @endIf method="POST">
            @csrf

            @if (isset($routine))
                <input name="id" type="hidden" value="{{ $routine->id }}">
            @endif

            <div class="card-header py-4 px-4">
                <div class="row">
                    <div class="col-sm-8 align-self-center">
                        <h2 class="mb-0">
                            <a href="{{ route('routines.index') }}">Rotinas</a>

                            @if(is_null($routine->id))
                                > Nova
                            @else
                                > {{ $routine->id }} - {{ $routine->entranced_at->format('d/m/Y \À\S H:i') }}
                            @endif

                        </h2>
                        @if (!Route::is('routines.create') )
                            @if ($routine['status'])
                                <label class="badge bg-success"> EM ABERTO </label>
                            @else
                                <label class="badge bg-danger"> FINALIZADA </label>
                            @endif
                        @endif
                    </div>
                    <div class="col-sm-4 align-self-center d-flex justify-content-end">
                        {{--<span class="required-msg">* Campos obrigatórios </span>--}}
                        @include('partials.save-button', ['model'=>$routine, 'backUrl' => 'routines.index', 'permission'=>($routine->status ? 'routines:update' : '')])
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
                    </div>
                </div>

                @if(formMode() == 'show')
                    @include('events.partials.table',['events'=>$routine->events])

                    @include('visitors.partials.table',['visitors'=>$routine->visitors])

                    @include('stuffs.partials.table',['stuffs'=>$routine->stuffs])

                    @include('cautions.partials.table',['cautions'=>$routine->cautions])
                @endIf
            </div>
        </form>
    </div>

@endsection
