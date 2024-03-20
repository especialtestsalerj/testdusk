<div>
    <div class="py-4 px-4" wire:poll.keep-alive>
        <form name="formulario" id="formulario"
              @if($mode == 'show') action="{{ route('visitors.update', ['id' => $visitor->id]) }}"
              @else action="{{ route('visitors.store')}}" @endIf method="POST">
            @csrf
            @if (isset($visitor->id))
                <input type="hidden" name="visitor_id" value="{{ $visitor->id }}">
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
                                'permission' => !request()->query('disabled') ? (formMode() == 'show' ? make_ability_name_with_current_building('visitors:update') : make_ability_name_with_current_building('visitors:store')) : ''])
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
                        'readonly' => $visitor->hasPending(), 'showRestrictions' => true,
                        'document_type_id'=> $document->document_type_id ?? null, 'document_number'=> $document->number ?? null, 'state_document_id'=> $document->state_id ?? null,
                        'card_id'=> $visitor->card_id ?? null, 'contact' => $this->contact ?? null])
                        <div class="row">
                            <div class="col-12">
                                <h4>
                                    Dados da Visita
                                </h4>
                            </div>
                            <div class="col-xl-6" wire:ignore>
                                <div class="form-group">
                                    <label for="entranced_at">Entrada*</label>
                                    <input type="datetime-local" max="3000-01-01T23:59"
                                           class="form-control text-uppercase" name="entranced_at" id="entranced_at"
                                           wire:model.lazy="visitor.entranced_at"
                                           @include('partials.disabled-by-query-string')
                                           @if($visitor->hasPending()) readonly @endif
                                    />
                                </div>
                            </div>
                            <div class="col-xl-6" wire:ignore>
                                <div class="form-group">
                                    <label for="exited_at">Saída</label>
                                    <input type="datetime-local" max="3000-01-01T23:59"
                                           class="form-control text-uppercase" name="exited_at" id="exited_at"
                                           value="{{$visitor->exited_at ?? ''}}"
                                           {{--
                                                Comentei pq estava com um comportamento estranho. Quando apaga o campo, ele preenche com a data atual. Tentei migrar para o Livewire 3, mas não consegui pq o mesmo está na versão beta e aconteciam outros bugs. A melhor solução que encontrei foi essa.
                                                wire:model.defer="visitor.exited_at"
                                           --}}
                                           @include('partials.disabled-by-query-string')
                                           @if($visitor->hasPending()) readonly @endif
                                    />
                                </div>
                            </div>
                            <div class="col-lg-12 col-xl-6" wire:ignore>


                                <div class="form-group">
                                    <label for="sector_id">Destino*</label>
                                    <select class="select2 form-control" name="sector_id[]" id="sector_id" multiple
                                            @include('partials.disabled-by-query-string') @if($visitor->hasPending()) readonly @endif>
                                        @foreach ($sectors as $key => $sector)
                                            @if(((!is_null($visitor->id)) && (!is_null($visitor->sectors) && $visitor->sectors->contains($sector->id) ) ||
                                            (!empty(old('sector_id'))) && in_array($sector->id, old('sector_id'))))
                                                <option value="{{ $sector->id }}" selected="selected">{{ $sector->name }}</option>
                                            @else
                                                <option value="{{ $sector->id }}">{{ $sector->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-xl-6">
                                <div class="form-group">
                                    <label for="card_id">Cartão</label>
                                    <div wire:ignore>
                                        <select class="select2 form-control text-uppercase"
                                                name="card_id" id="card_id"
                                                wire:model="card_id"
                                                @include('partials.disabled-by-query-string') @if($visitor->hasPending()) readonly @endif>
                                            <option value="">SEM CARTÃO</option>
                                            @foreach ($cards as $card)
                                                @if(((!is_null($card->id)) || ((!is_null(old('card_id'))) && old('card_id') == $card->id)))
                                                    <option value="{{ $card->id }}" selected="selected">
                                                        {{ convert_case($card->number, MB_CASE_UPPER) }}
                                                    </option>
                                                @else
                                                    <option value="{{ $card->id }}">
                                                        {{ convert_case($card->number, MB_CASE_UPPER) }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="description">Motivo da Visita*</label>
                                    <textarea class="form-control" name="description" id="description" wire:ignore
                                              placeholder="Informe detalhes da autorização"
                                        @include('partials.disabled-by-query-string') >{{ is_null(old('description')) ? $visitor->description: old('description') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div
                x-init="Webcam.attach('#webcam')"
            >

            </div>
            @include('visitors.partials.webcam-modal')
        </form>
    </div>

    @include('partials.button-to-top')

</div>
