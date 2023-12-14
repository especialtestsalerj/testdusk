<div>
    <div wire:ignore.self class="modal fade" data-bs-backdrop="static" id="restriction-modal" tabindex="-1" role="dialog"
         aria-labelledby="retrictionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form wire:submit.prevent="store">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            @switch($modalMode)
                                @case('create')
                                <i class="fas fa-plus"></i> Nova Restrição
                                @break
                                @case('update')
                                <i class="fas fa-pencil"></i> Alteração de Restrição
                                @break
                                @default
                                <i class="fas fa-person-circle-exclamation"></i> Restrição
                            @endswitch
                        </h5>
                        <button type="button" class="btn-close" wire:click="cleanModal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 d-flex justify-content-end">
                                <span class="badge bg-info text-black required-msg"><i class="fa fa-circle-info"></i> * Campos obrigatórios</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="building_id">Unidade*</label>
                            <select class="form-select text-uppercase" name="building_id"
                                    id="building_id" wire:model="building_id"
                                    x-ref="building_id">
                                <option value="">selecione</option>
                                @foreach ($buildings as $building)
                                    <option
                                        value="{{ $building->id }}"> {{ $building->name }}</option>
                                @endforeach
                            </select>
                            @error('building_id')
                            <small class="text-danger">
                                <i class="fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </small>
                            @endError
                        </div>
                        <div class="form-group">
                            <label for="started_at">Início*</label>
                            <input type="datetime-local" max="3000-01-01T23:59"
                                   class="form-control text-uppercase" name="started_at"
                                   id="started_at"
                                   wire:model="started_at"
                                   @disabled($readonly)
                            />
                            @error('started_at')
                            <small class="text-danger">
                                <i class="fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </small>
                            @endError
                        </div>
                        <div class="form-group">
                            <label for="ended_at">Término</label>
                            <input type="datetime-local" max="3000-01-01T23:59"
                                   class="form-control text-uppercase" name="ended_at"
                                   id="ended_at"
                                   wire:model="ended_at"
                                   @disabled($readonly)
                            />
                        </div>
                        <div class="form-group">
                            <label for="message">Mensagem*</label>
                            <textarea class="form-control" name="message" id="message"
                                      rows="3" placeholder="Informe a mensagem que será repassada aos usuários"
                                      wire:model="message" @disabled($readonly)>
                            </textarea>
                            @error('message')
                            <small class="text-danger">
                                <i class="fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </small>
                            @endError
                        </div>

                        <div class="form-group">
                            <label for="description">Descrição*</label>
                            <textarea class="form-control" name="description"
                                      id="description" rows="7" placeholder="Informe uma justificativa para a restrição"
                                      wire:model="description" @disabled($readonly)>
                            </textarea>
                            @error('description')
                            <small class="text-danger">
                                <i class="fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </small>
                            @endError
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success text-white ml-1" id="submitButton" title="Salvar" @disabled($readonly)>
                            <i class="fa fa-save"></i> Salvar
                        </button>
                        <button type="button"
                                class="btn btn-danger text-white close-btn"
                                wire:click="cleanModal" title="Fechar Formulário"><i
                                class="fas fa-ban"></i> Cancelar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
