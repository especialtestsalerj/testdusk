<div>
    <div class="py-4 px-4">
        <form name="formulario" id="formulario" method="POST"
              @if($mode=='create') action="{{ route('cautions.store', ['routine_id' => $routine_id]) }}"
              @else action="{{ route('cautions.update', ['routine_id' => $routine_id, 'id' => $caution_id]) }}" @endIf>
            @csrf

            @if (isset($caution))
                <input type="hidden" name="id" value="{{ $caution_id }}">
            @endif
            <input type="hidden" name="routine_id" value="{{ $routine_id }}">
            <input type="hidden" name="redirect" value="{{ $redirect }}">

            <div class="">
                <div class="row">
                    <div class="col-sm-8 align-self-center">
                        <h3 class="mb-0">
                            <i class="fas fa-person-rifle"></i> Cautelas de Armas
                        </h3>
                        @if(!is_null($caution_id))
                            @if(!$caution->hasWeapons())
                                <span class="badge bg-danger text-white"><i class="fa fa-exclamation-triangle"></i> SEM ARMA(S) </span>
                            @endif
                        @endif
                        @if($caution->hasPending())
                            <span class="badge bg-warning text-black"><i class="fa fa-exclamation-triangle"></i> ROTINA ANTERIOR </span>
                            <span class="badge bg-warning text-black"><i class="fa fa-exclamation-triangle"></i> Só poderá fechar a cautela ou dar saída numa das armas </span>
                        @endif
                    </div>

                    <div class="col-sm-4 align-self-center d-flex justify-content-end gap-4">
                        @include('partials.save-button', ['model' => $caution, 'backUrl' => $redirect, 'permission'=>($routine->status && !request()->query('disabled') ? (formMode() == 'show' ? 'cautions:update' : 'cautions:store') : ''), 'id' =>$routine_id])
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
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="started_at">Abertura*</label>
                            <input type="datetime-local" max="3000-01-01T23:59" class="form-control text-uppercase" name="started_at" id="started_at" wire:model.defer="started_at" @disabled(!$routine->status || request()->query('disabled')) @readonly($caution->hasPending())/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="concluded_at">Fechamento</label>
                            <input type="datetime-local" max="3000-01-01T23:59" class="form-control text-uppercase" name="concluded_at" id="concluded_at" wire:model.defer="concluded_at" @disabled(!$routine->status || request()->query('disabled'))/>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12" wire:ignore>
                        <div class="form-group">
                            <label for="visitor_id">Visitante*</label>
                            <select class="form-select select2" name="visitor_id" id="visitor_id" @disabled(!$routine->status || request()->query('disabled')) @readonly($caution->hasPending())>
                                <option value="">SELECIONE</option>
                                @foreach ($visitors as $key => $visitor)
                                    <option value="{{ $visitor->id }}" @if($visitor->id == $visitor_id) selected="selected" @endif>
                                        {{ $visitor->person->name }} - {{ $visitor->document->documentType->name }}: {{ $visitor->document->numberMaskered }}
                                    </option>
                                @endforeach
                            </select>
                            <div>
                                @if(isset($msg_visitor))
                                <small class="text-danger">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    {{ $msg_visitor }}
                                </small>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="destiny_sector_name">Destino</label>
                            <input
                                type="text"
                                class="form-control text-uppercase"
                                name="destiny_sector_name"
                                id="destiny_sector_name"
                                value="{{$this->destinySectorName}}"
                                @disabled(true)
                            >
                        </div>
                    </div>
                </div>
                <div class="row">
                    @if ($mode == 'create')
                        <div class="col-md-4" wire:ignore>
                            <div class="form-group">
                                <label for="person_certificate">Certificados do/a Visitante</label>
                                <select class="form-select select2" name="person_certificate" id="person_certificate" @disabled(!$routine->status || request()->query('disabled')) @readonly($caution->hasPending())>
                                    <option value="">SELECIONE</option>
                                </select>
                            </div>
                        </div>
                    @endif
                    <div class="col-md-3" wire:ignore>
                        <div class="form-group">
                            <label for="certificate_type_id">Tipo de Porte*</label>
                            <select class="select2 select2-tags form-control" name="certificate_type_id" id="certificate_type_id" wire:model.defer="certificate_type_id" @disabled(!$routine->status || request()->query('disabled')) @readonly($caution->hasPending())>
                                <option value="">SELECIONE</option>
                                @foreach ($certificateTypes as $key => $certificateType)
                                    @if(((!is_null($caution_id)) && (!is_null($caution->certificate_type_id) && $caution->duty_user_id === $certificateType->id) || (!is_null(old('certificate_type_id'))) && old('certificate_type_id') == $certificateType->id))
                                        <option value="{{ $certificateType->id }}" selected="selected">{{ $certificateType->name }}</option>
                                    @else
                                        <option value="{{ $certificateType->id }}">{{ $certificateType->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="certificate_number">{{ ($certificate_type_id == config('app.certificate_type_particular')) ? 'Núm. Certificado*' : 'Matrícula*' }}</label>
                            <input
                                type="text"
                                class="form-control text-uppercase"
                                name="certificate_number"
                                id="certificate_number"
                                wire:model.defer="certificate_number"
                                @disabled(!$routine->status || request()->query('disabled')) @readonly($caution->hasPending())
                            />
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="certificate_valid_until">Validade{{ ($certificate_type_id == config('app.certificate_type_particular')) ? '*' : '' }}</label>
                            <input
                                type="date"
                                class="form-control text-uppercase"
                                name="certificate_valid_until"
                                id="certificate_valid_until"
                                wire:model.defer="certificate_valid_until"
                                @disabled(!$routine->status || request()->query('disabled')) @readonly($caution->hasPending())
                            >
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12" wire:ignore>
                        <div class="form-group">
                            <label for="duty_user_id">Plantonista*</label>
                            <select class="select2 form-control" name="duty_user_id" id="duty_user_id" wire:model.defer="duty_user_id" @disabled(!$routine->status || request()->query('disabled')) @readonly($caution->hasPending())>
                                <option value="">SELECIONE</option>
                                @foreach ($users as $key => $user)
                                    @if(((!is_null($caution_id)) && (!is_null($caution->duty_user_id) && $caution->duty_user_id === $user->id) || (!is_null(old('duty_user_id'))) && old('duty_user_id') == $user->id))
                                        <option value="{{ $user->id }}" selected="selected">{{ $user->name }}</option>
                                    @else
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="description">Observações</label>
                            <textarea class="form-control" name="description" id="description" wire:model.defer="description" @if(!$routine->status || request()->query('disabled')) disabled @endif>{{ is_null(old('description')) ? $caution->description: old('description') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        @if ($mode == 'show')
            <div class="">
                <livewire:caution-weapons.index-form :caution_id="$caution->id" :routine="$routine" :disabled="(!$routine->status || request()->query('disabled'))" />
            </div>
        @else
            <div class="alert alert-warning mt-2">
                <i class="fa fa-exclamation-triangle"></i> Para adicionar armas, salve primeiramente o cadastro da cautela.
            </div>
        @endif
    </div>
</div>
