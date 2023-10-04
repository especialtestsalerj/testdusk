<div
    x-init=""
    x-data=""
    @focus-field.window="if($refs[$event.detail.field]) {$refs[$event.detail.field].focus()}"
    @change-mask.window="
     setTimeout(() => {
        // console.log($event); console.log($refs[$event.detail.ref]);
        if($refs[$event.detail.ref]) {
            if($event.detail.mask){
                //console.log('changed mask of '+$refs[$event.detail.ref]+' to '+$event.detail.mask)
                VMasker($refs[$event.detail.ref]).maskPattern($event.detail.mask);
            }else{
                var fieldValue = $refs[$event.detail.ref].value;
                VMasker($refs[$event.detail.ref]).unMask();

                // Set the stored value back into the input field
                $refs[$event.detail.ref].value = fieldValue;
            }
         }
        }, 500);
     "
>
    <div wire:ignore.self class="modal fade" id="document-modal" tabindex="-1" role="dialog"
         aria-labelledby="documentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form wire:submit.prevent="store">
                    @csrf
                    <input type="hidden" name="person_id" wire:model="person_id">

                    <div class="modal-header">
                        <h5 class="modal-title">
                            <i class="fa fa-{{ $this->person ? 'plus' : 'pencil'}}"></i> {{ $this->person ? 'Novo Documento' : 'Alteração de Documento'}}
                        </h5>
                        <button wire:click.prevent="cleanModal" type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 d-flex justify-content-end">
                                <span class="badge bg-info text-black required-msg"><i class="fa fa-circle-info"></i> * Campos obrigatórios</span>
                            </div>
                        </div>

                        @isset($this->person)
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="document_type_id">Tipo de Documento*</label>
                                    <select class="form-select text-uppercase" name="document_type_id"
                                            id="document_type_id" wire:model="document_type_id"
                                            x-ref="document_type_id">
                                        <option value="">selecione</option>
                                        @foreach ($documentTypes as $documentType)
                                            <option
                                                value="{{ $documentType->id }}"> {{ $documentType->name }}</option>
                                        @endforeach

                                    </select>
                                    <div>
                                        @error('document_type_id')
                                        <small class="text-danger">
                                            <i class="fas fa-exclamation-triangle"></i>
                                            {{ $message }}
                                        </small>
                                        @endError
                                    </div>
                                </div>
                            </div>
                        @endisset

                        @if ($document_type_id == config('app.document_type_rg'))
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="state_id">Estado*</label>
                                    <select class="form-select text-uppercase" name="state_id" id="state_id"
                                            wire:model="state_id"
                                            x-ref="state_id" @disabled(request()->query('disabled'))>
                                        <option value="">selecione</option>
                                        @foreach ($states as $state)
                                            <option value="{{ $state->id }}"> {{ convert_case($state->name, MB_CASE_UPPER) }}</option>
                                        @endforeach

                                    </select>
                                    <div>
                                        @error('state_id')
                                        <small class="text-danger">
                                            <i class="fas fa-exclamation-triangle"></i>
                                            {{ $message }}
                                        </small>
                                        @endError
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="col-12">
                            <div class="form-group">
                                <label for="number">Número*</label>
                                <input type="text" class="form-control text-uppercase"
                                       id="number" name="number" wire:model="number" x-ref="document_number"/>
                                <div>
                                    @error('number')
                                    <small class="text-danger">
                                        <i class="fas fa-exclamation-triangle"></i>
                                        {{ $message }}
                                    </small>
                                    @endError
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" dusk="submit" class="btn btn-success btn-sm text-white close-modal"
                                title="Salvar Documento" id="submitSalvarDocumento"><i class="fa fa-save"></i> Salvar
                        </button>
                        <button type="button" dusk="cancel" wire:click.prevent="cleanModal()"
                                class="btn btn-danger btn-sm text-white close-btn" data-bs-dismiss="modal"
                                title="Fechar Formulário"><i class="fas fa-ban"></i> Cancelar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
