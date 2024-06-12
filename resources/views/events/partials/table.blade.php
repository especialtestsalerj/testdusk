<div class="row mb-2">
    <div class="col-md-12">
        <div class="row my-4">
            <div class="col-sm-8 align-self-center">
                <h3 class="mb-0">
                    <i class="fas fa-list-check"></i> Ocorrências
                </h3>
            </div>
            <div class="col-sm-4 align-self-center d-flex justify-content-end">
                @if($routine->status)
                    <a href="{{ route('events.create', ['routine_id' => $routine->id, 'redirect' => $redirect]) }}" class="btn btn-primary text-white float-end" title="Nova Ocorrência" dusk="newEvent">
                        <i class="fa fa-plus"></i> Nova
                    </a>
                @endif
            </div>
        </div>
        @forelse ($events as $event)
            <div class="cards-striped mx-lg-0 mt-lg-2 my-2">
                <div class="card">
                    <div class="card-body py-1">
                        <div class="row d-flex align-items-center">
                            <div class="col-12 col-lg-2 text-center text-lg-start">
                                <span class="fw-bold">Data:</span> {{ $event?->occurred_at?->format('d/m/Y \À\S H:i') ?? '-'}}
                            </div>
                            <div class="col-12 col-lg-2 text-center text-lg-start">
                                <span class="fw-bold">Tipo:</span> {{ $event->eventType->name }}
                            </div>
                            <div class="col-12 col-lg-3 text-center text-lg-start">
                                <span class="fw-bold">Setor:</span> {{ $event?->sector?->name ?? '-' }}
                            </div>
                            <div class="col-12 col-lg-3 text-center text-lg-start">
                                <span class="fw-bold">Plantonista:</span> {{ $event->dutyUser->name }}
                            </div>
                            <div class="col-12 col-lg-2 text-center text-lg-end">
                                <a href="{{ route('events.show', ['routine_id' => $routine_id, 'id' => $event->id, 'redirect' => $redirect, 'disabled' => true]) }}" class="btn btn-link" title="Detalhar"><i class="fa fa-lg fa-search"></i></a>
                                @if($routine->status)
                                    <a href="{{ route('events.show', ['routine_id' => $routine_id, 'id' => $event->id, 'redirect' => $redirect]) }}" class="btn btn-link" title="Alterar" id="editEvent"><i class="fa fa-lg fa-pencil"></i></a>
                                    <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#event-delete-modal{{ $event->id }}" title="Remover" id="removerEvent">
                                        <i class="fa fa-lg fa-trash"></i>
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="event-delete-modal{{ $event->id }}" tabindex="-1" aria-labelledby="deleteModalLabelEvent" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form class="form" action="{{ route('events.destroy', ['routine_id' => $routine_id, 'id' => $event->id]) }}" method="post">
                            @csrf
                            <input type="hidden" name="redirect" value="{{ $redirect }}">

                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabelEvent"><i class="fa fa-trash"></i> Remoção de Ocorrência</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="event_type_id">Tipo</label>
                                    <select class="form-select form-control" name="event_type_id" id="event_type_id" disabled>
                                        <option value="{{ $event->eventType?->id }}" selected="selected">{{ $event->eventType?->name }}</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="occurred_at">Data</label>
                                    <input type="datetime-local" max="3000-01-01T23:59" class="form-control text-uppercase" name="occurred_at" id="occurred_at" value="{{ $event->occurred_at }}" disabled/>
                                </div>
                                <div class="form-group">
                                    <label for="sector_id">Setor</label>
                                    <select class="form-select form-control" name="sector_id" id="sector_id" disabled>
                                        <option value="{{ $event->sector?->id }}" selected="selected">{{ $event->sector?->name }}</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="duty_user_id">Plantonista</label>
                                    <select class="form-select form-control" name="duty_user_id" id="duty_user_id" disabled>
                                        <option value="{{ $event->dutyUser?->id }}" selected="selected">{{ $event->dutyUser?->name }}</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="description">Observações</label>
                                    <textarea class="form-control" name="description" id="description" rows="10" disabled>{{ $event->description }}</textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success btn-sm text-white close-modal" id="submitRemoverEvento" title="Remover Ocorrência"><i class="fa fa-check"></i> Remover</button>
                                <button type="button" class="btn btn-danger btn-sm text-white close-btn" data-bs-dismiss="modal" title="Fechar Formulário"><i class="fa fa-ban"></i> Cancelar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="alert alert-warning">
                <i class="fa fa-lg fa-exclamation-triangle"></i> Nenhuma Ocorrência encontrada.
            </div>
        @endforelse
    </div>
</div>
