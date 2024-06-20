<div>
    <div wire:ignore.self class="modal fade" id="blocked-date-modal" tabindex="-1" role="dialog"
         aria-labelledby="capacityModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form wire:submit.prevent="store">
                    @csrf
                    <input type="hidden" name="sector_id" wire:model="sector_id">

                    <div class="modal-header">
                        <h5 class="modal-title">
                            <i class="fa fa-plus"></i> Nova Indisponibilidade
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

                        <div class="col-6">
                            <div class="form-group">
                                <label for="number">Data*</label>
                                <input type="date" class="form-control text-uppercase"
                                       id="date" name="date" wire:model="date" x-ref="date"/>
                                <div>
                                    @error('hour')
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
                                title="Salvar Horário" id="submitSalvarBlockedDate"><i class="fa fa-save"></i> Salvar
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
