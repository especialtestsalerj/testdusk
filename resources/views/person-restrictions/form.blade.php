@extends('layouts.app')

@section('content')
    <div class="py-4 px-4">
        <form name="formulario" id="formulario" @if(formMode() == 'show') action="{{ route('person-restrictions.update', ['id' => $personRestriction->id]) }}" @else action="{{ route('person-restrictions.store')}}" @endIf method="POST">
            @csrf

            @if (isset($personRestriction))
                <input type="hidden" name="id" value="{{ $personRestriction->id }}">
            @endif

            <div class="">
                <div class="row">
                    <div class="col-sm-8 align-self-center">
                        <h3 class="mb-0">
                            <a href="{{ route('person-restrictions.index') }}"><i class="fas fa-person-circle-exclamation"></i> Restrições de Acesso</a>

                            @if(is_null($personRestriction->id))
                                > Nova
                            @else
                                > {{ $personRestriction->id }} - {{ $personRestriction?->person?->full_name }} - {{ $personRestriction?->person?->cpf_formatted }}
                            @endif
                        </h3>
                    </div>

                    <div class="col-sm-4 align-self-center d-flex justify-content-end gap-4">
                        @include('partials.save-button', ['model' => $personRestriction, 'backUrl' => 'person-restrictions.index', 'permission' => (formMode() == 'show' ? 'person-restrictions:update' : 'person-restrictions:store')])
                    </div>
                </div>
            </div>

            <div class="card-body my-2">
                @include('layouts.msg')
                <div class="row">
                    <div class="col-12 d-flex justify-content-end">
                        <span class="badge bg-info text-black required-msg"><i class="fa fa-circle-info"></i> * Campos obrigatórios</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-11">
                        <div class="form-group" wire:ignore>
                            <label for="visitor_id">Pessoa*</label>
                            <select class="form-select select2" name="person_id" id="person_id"
                                    @if(isset($readonly) && $readonly) readonly @endif
                            >
                                <option value="">SELECIONE</option>
                                @foreach ($people as $key => $person)
                                    <option value="{{ $person->id }}" @if($person->id == $personRestriction->person_id) selected="selected" @endif>
                                        {{ $person->name }}
                                        @foreach ($person->documents as $document)
                                            - {{ $document->documentType->name }}: {{ $document->numberMaskered }}
                                        @endforeach
                                    </option>
                                @endforeach
                            </select>
                            <div>
                                @error('person_id')
                                    <small class="text-danger">
                                        <i class="fas fa-exclamation-triangle"></i>
                                        {{ $message }}
                                    </small>
                                @endError
                            </div>
                        </div>
                    </div>
                    <div class="col-md-1 mt-md-4">
                        <div class="form-group">
                            <button type="button" data-bs-toggle="modal" data-bs-target="#peopleModal"
                               class="btn btn-primary text-white float-left" title="Nova Pessoa">
                                <i class="fa fa-plus"></i> Nova
                            </button>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="started_at">Início*</label>
                            <input type="datetime-local" max="3000-01-01T23:59" class="form-control text-uppercase" name="started_at" id="started_at" value="{{ is_null(old('occurred_at')) ? (formMode() == 'create' ? date('Y-m-d H:i') : $personRestriction->started_at) : old('started_at') }}" @disabled(request()->query('disabled'))/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="ended_at">Término</label>
                            <input type="datetime-local" max="3000-01-01T23:59" class="form-control text-uppercase" name="ended_at" id="ended_at" value="{{ is_null(old('ended_at')) ? $personRestriction->ended_at_formatted: old('ended_at') }}" @disabled(request()->query('disabled'))/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label for="message">Mensagem*</label>
                        <textarea class="form-control" name="message" id="message" @disabled(request()->query('disabled'))>{{ is_null(old('message')) ? $personRestriction->message : old('message') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="description">Descrição*</label>
                        <textarea class="form-control" name="description" id="description" @disabled(request()->query('disabled'))>{{ is_null(old('description')) ? $personRestriction->description : old('description') }}</textarea>
                    </div>
                </div>
            </div>
        </form>

        @include('person-restrictions.partials.modal')
    </div>
@endsection
