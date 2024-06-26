<div>
    <div wire:ignore.self class="modal fade" data-bs-backdrop="static" id="contact-modal" tabindex="-1" role="dialog"
         aria-labelledby="contactModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            <i class="fa fa-{{ $this->contact_id ? 'pencil' : 'plus'}}"></i> {{ $this->contact_id ? 'Alteração de Contato' : 'Novo Contato'}}
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
                        <div class="col-md-12 pt-3">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="list-unstyled">
                                        @foreach ($errors->all() as $error)
                                            <li><i class="fa fa-lg fa-exclamation-circle"></i> {{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>

                        <livewire:contacts.form :is-required="true" :person_id="$person_id"/>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" dusk="submit" class="btn btn-success btn-sm text-white close-modal"
                                title="Salvar Contato" id="submitSalvarContato" wire:click.prevent="storeContact()"><i class="fa fa-save"></i> Salvar
                        </button>
                        <button type="button" dusk="cancel" wire:click.prevent="cleanModal()"
                                class="btn btn-danger btn-sm text-white close-btn" data-bs-dismiss="modal"
                                title="Fechar Formulário"><i class="fas fa-ban"></i> Cancelar
                        </button>
                    </div>

            </div>
        </div>
    </div>
</div>

