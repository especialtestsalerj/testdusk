<div class="modal fade" id="documentModalForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Criando nova Pessoa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 d-flex align-items-end">
                        <div class="col-md-4">

                            <label for="cpf">Documento:</label>
                            <input
                                type="text"
                                class="form-control @error('cpf') is-invalid @endError"
                                name="cpf"
                                id="cpf"
                                wire:model.lazy="cpf"
                                x-ref="cpf"
                                @if($modal) disabled @endif @if($readonly) readonly @endif
                            />
                        </div>
                        <div class="col-md-4">
                            <label for="document_type_id">Tipo de Documento</label>
                            <select name="document_type_id"  id="documentTypeId" class="select2">
                                <option value="">Selecione</option>
                                @foreach($documentTypes as $documentType)
                                    <option value="{{$documentType->id}}">{{$documentType->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">

                        <label for="cpf">Nome:</label>
                        <input
                            type="text"
                            class="form-control @error('cpf') is-invalid @endError"
                            name="full_name"
                            id="full_name"
                            wire:model.lazy="full_name"
                            x-ref="full_name"
                            @if($modal) disabled @endif @if($readonly) readonly @endif
                        />
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">

                        <label for="cpf">Nome Social:</label>
                        <input
                            type="text"
                            class="form-control @error('cpf') is-invalid @endError"
                            name="social_name"
                            id="social_name"
                            wire:model.lazy="social_name"
                            x-ref="social_name"
                            @if($modal) disabled @endif @if($readonly) readonly @endif
                        />
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary">Salvar</button>
            </div>
        </div>
    </div>
    <script>
        $('#documentTypeId').select2({
            dropdownParent: $('#documentModalForm')
        });
    </script>
</div>
