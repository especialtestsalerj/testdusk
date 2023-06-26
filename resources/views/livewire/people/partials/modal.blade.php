<div class="modal fade" id="documentModalForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Criando nova Pessoa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="col-md-12 d-flex align-items-end">
                    <div class="col-md-4">
                        <input name="person_id" id="person_id" type="hidden" wire:model.defer="person_id">
                        <label for="cpf">Documento:</label>
                        <input
                            type="text"
                            class="form-control @error('cpf') is-invalid @endError"
                            name="cpf"
                            id="cpf"
                            wire:model.lazy="cpf"
                            x-ref="cpf"
                            wire:blur="searchDocumentNumber"
                            @if($modal) disabled @endif @if($readonly) readonly @endif
                        />
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary">Salvar</button>
            </div>
        </div>
    </div>
</div>
