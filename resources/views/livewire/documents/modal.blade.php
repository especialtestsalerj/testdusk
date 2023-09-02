<div>
    <div wire:ignore.self class="modal fade" id="document-modal" tabindex="-1" role="dialog"
        aria-labelledby="weaponModalLabel" aria-hidden="true">
        <form wire:submit.prevent="store">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            <i class="fa fa-{{ $this->person ? 'plus' : 'pencil'}}"></i> {{ $this->person ? 'Novo Documento' : 'Alteração de Documento'}}
                        </h5>
                        <button wire:click.prevent="cleanModal" type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <input type="hidden" name="person_id" wire:model="person_id">

                        <div class="row">
                            @isset($this->person)
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="entranced_at">Tipo de Documento*</label>
                                        <select class="form-control text-uppercase" name="document_type_id"
                                            id="document_type_id" wire:model="document_type_id" x-ref="document_type_id">
                                            <option value="">selecione</option>
                                            @foreach ($documentTypes as $documentType)
                                                <option value="{{ $documentType->id }}"> {{ $documentType->name }}</option>
                                            @endforeach

                                        </select>
                                        <div>
                                            @error('entranced_at')
                                                <small class="text-danger">
                                                    <i class="fas fa-exclamation-triangle"></i>

                                                </small>
                                            @endError
                                        </div>
                                    </div>
                                </div>
                            @endisset
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exited_at">Número</label>
                                    <input type="text" max="3000-01-01T23:59" class="form-control text-uppercase"
                                        name='number' wire:model="number" x-ref="number" />
                                    <div>
                                        @error('exited_at')
                                            <small class="t ext-danger">
                                                <i class="fas fa-exclamation-triangle"></i>

                                            </small>
                                        @endError
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if ($document_type_id == 2)
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="entranced_at">Estado*</label>
                                        <select class="form-control text-uppercase" name="state_id" id="state_id"
                                            wire:model="state_id" x-ref="state_id" @disabled(request()->query('disabled'))>
                                            <option value="">selecione</option>
                                            @foreach ($states as $state)
                                                <option value="{{ $state->id }}"> {{ $state->name }}</option>
                                            @endforeach

                                        </select>
                                        <div>
                                            @error('entranced_at')
                                                <small class="text-danger">
                                                    <i class="fas fa-exclamation-triangle"></i>

                                                </small>
                                            @endError
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                    </div>

                    <div class="modal-footer">
                        <button type="submit" dusk="submit" data-bs-dismiss="modal"
                            class="btn btn-success btn-sm text-white close-modal" title="Salvar" id="salvarWeapon"><i
                                class="fa fa-save"></i> Salvar
                        </button>
                        <div>
                            <button type="button" dusk="cancel" wire:click.prevent="cleanModal()"
                                class="btn btn-danger btn-sm text-white close-btn" data-bs-dismiss="modal"
                                title="Fechar formulário"><i class="fas fa-ban"></i> Cancelar</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
