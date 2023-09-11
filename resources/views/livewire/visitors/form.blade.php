<div>
    <div class="py-4 px-4" wire:keep-alive>
        <form name="formulario" id="formulario" @if($mode == 'show') action="{{ route('visitors.update', ['id' => $visitor->id]) }}" @else action="{{ route('visitors.store')}}" @endIf method="POST">
            @csrf
            @if (isset($visitor->id))
                <input type="hidden" name="id" value="{{ $visitor->id }}">
            @endif
            <input type="hidden" name="redirect" value="{{ request()->query('redirect') }}">

            <div class="">
                <div class="row">
                    <div class="col-sm-8 align-self-center">
                        <h3 class="mb-0">
                            <a href="{{ route('visitors.index')  }}"><i class="fa fa-people-roof"></i> Visitas</a>
                            @if(is_null($visitor->id))
                                > Nova
                            @else
                                > {{ $visitor->id }} - {{ $visitor->entranced_at->format('d/m/Y \À\S H:i') }}
                            @endif
                        </h3>
                        @if($visitor->hasPending())
                            <span class="badge bg-warning text-black"><i class="fa fa-exclamation-triangle"></i> ROTINA ANTERIOR</span>
                        @endif
                    </div>
                    <div class="col-sm-4 align-self-center d-flex justify-content-end gap-4">
                        @include('partials.save-button',
                                ['model' => $visitor, 'backUrl' => 'visitors.index',
                                'showSave'=>!(isset($mode) && $mode == 'show-read-only'), //showSave = true if and only if $mode='show-read-only'
                                'permission' => !request()->query('disabled') ? (formMode() == 'show' ? 'visitors:update' : 'visitors:store') : ''])
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
                    <div class="col-12 col-xl-4 g-1">
                        <div class="col-12">
                            <h4 class="text-center">
                                Etiqueta
                            </h4>
                        </div>
                        <div class="col-12">
                            <div class="position-sticky">
                                <div class="zoom col-12 d-flex justify-content-center mt-3">
                                    @include('livewire.visitors.partials.badge', ['printVisitor' => $visitor, 'forPrinter'=> false])
                                </div>
                                <div class="col-12">
                                    <div class="row d-flex justify-content-center">
                                        <div class="d-grid gap-2 col-7 col-xxl-9 mt-2 mb-5">
                                            @include('visitors.partials.webcam-button')
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-xl-8 g-1">
                        <div class="col-12">
                            <h4>
                                Dados do/a Visitante
                            </h4>
                        </div>
                        @livewire('people.people', ['person_id'=>empty(request()->get('person_id')) ? $visitor->person_id  : request()->get('person_id'),
                        'person' => $visitor->person, 'visitor_id'=>$visitor->id, 'mode' => $mode, 'modal' => request()->query('disabled'),
                        'readonly' => $visitor->hasPending(), 'showRestrictions' => true, 'document_number'=> request()->query('document_number'),
                        'document_type_id'=> request()->query('document_type_id'), 'full_name'=> request()->query('full_name'), 'photo'=>$visitor->photo ?? ''])
                        <div class="row">
                            <div class="col-12">
                                <h4>
                                    Dados da Visita
                                </h4>
                            </div>
                            <div class="col-lg-6 col-xl-3">
                                <div class="form-group">
                                    <label for="entranced_at">Entrada</label>
                                    <input type="datetime-local" max="3000-01-01T23:59" class="form-control text-uppercase" name="entranced_at" id="entranced_at" wire:model.lazy="visitor.entranced_at" @disabled(request()->query('disabled')) @if($visitor->hasPending()) readonly @endif/>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xl-3">
                                <div class="form-group">
                                    <label for="entranced_at">Saída</label>
                                    <input type="datetime-local" max="3000-01-01T23:59" class="form-control text-uppercase" name="exited_at" id="exited_at" wire:model.lazy="visitor.exited_at" @disabled(request()->query('disabled')) @if($visitor->hasPending()) readonly @endif/>
                                </div>
                            </div>
                            <div class="col-lg-12 col-xl-6" wire:ignore>
                                <div class="form-group">
                                    <label for="sector_id">Destino*</label>
                                    <select class="select2 form-control" name="sector_id" id="sector_id"
                                            @disabled(request()->query('disabled')) @if($visitor->hasPending()) readonly @endif>
                                        <option value="">SELECIONE</option>
                                        @foreach ($sectors as $key => $sector)
                                            @if(((!is_null($visitor->id)) && (!is_null($visitor->sector_id) && $visitor->sector_id === $sector->id) || (!is_null(old('sector_id'))) && old('sector_id') == $sector->id))
                                                <option value="{{ $sector->id }}" selected="selected">{{ $sector->name }}</option>
                                            @else
                                                <option value="{{ $sector->id }}">{{ $sector->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="description">Motivo da Visita*</label>
                                    <textarea class="form-control" name="description" id="description" wire:ignore
                                        @disabled(request()->query('disabled')) >{{ is_null(old('description')) ? $visitor->description: old('description') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('visitors.partials.webcam-modal')
        </form>
    </div>

    @include('partials.button-to-top')

</div>
