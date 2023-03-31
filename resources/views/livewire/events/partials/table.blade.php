<div class="cards-striped mx-3 mx-lg-0 mt-lg-4">

    <div class="card card-routine m-1">
        <div class="card-body py-1">
            <div class="row d-flex align-items-center">
                <div class="col-12 col-lg-2 text-center text-lg-start">
                    <span class="fw-bold">Data/Hora :</span> 14/02/2023 ÀS 17:32
                </div>
                <div class="col-12 col-lg-2 text-center text-lg-start">
                    <span class="fw-bold">Tipo :</span> TESTE OCORRENCIA
                </div>
                <div class="col-12 col-lg-2 text-center text-lg-start">
                    <span class="fw-bold">Setor :</span> Novo Setor
                </div>
                <div class="col-12 col-lg-4 text-center text-lg-start">
                    <span class="fw-bold">Plantonista :</span> Nome do Plantonista Teste Nome Longo
                </div>

                <div class="col-12 col-lg-2 text-center text-lg-end">
                    <a href="http://ocorrencias.test/events/index/show/3/1?disabled=1" class="btn btn-link" title="Detalhar"><i class="fa fa-search"></i></a>
                    <a href="http://ocorrencias.test/events/index/show/3/1" class="btn btn-link" title="Alterar"><i class="fa fa-pencil"></i></a>
                    <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#delete-modal1" title="Remover">
                        <i class="fa fa-trash"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="cards-striped mx-3 mx-lg-0 mt-lg-4">
    <div class="card card-routine m-1">
        <div class="card-body py-1">
            <div class="row d-flex align-items-center">
                <div class="col-12 col-lg-2 text-center text-lg-start">
                    <span class="fw-bold">Data/Hora :</span> 14/02/2023 ÀS 17:32
                </div>
                <div class="col-12 col-lg-2 text-center text-lg-start">
                    <span class="fw-bold">Tipo :</span> TESTE OCORRENCIA
                </div>
                <div class="col-12 col-lg-2 text-center text-lg-start">
                    <span class="fw-bold">Setor :</span> Novo Setor
                </div>
                <div class="col-12 col-lg-4 text-center text-lg-start">
                    <span class="fw-bold">Plantonista :</span> Nome do Plantonista Teste Nome Longo
                </div>
                <div class="col-12 col-lg-2 text-center text-lg-end">
                    <a href="http://ocorrencias.test/events/index/show/3/1?disabled=1" class="btn btn-link" title="Detalhar">
                        <i class="fa fa-search"></i>
                    </a>
                    <a href="http://ocorrencias.test/events/index/show/3/1" class="btn btn-link" title="Alterar">
                        <i class="fa fa-pencil"></i>
                    </a>
                    <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#delete-modal1" title="Remover">
                        <i class="fa fa-trash"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>


<table id="eventTable" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th class="col-md-2">Data/Hora</th>
            <th class="col-md-3">Tipo</th>
            <th class="col-md-2">Setor</th>
            <th class="col-md-3">Plantonista</th>
            <th class="col-md-2"></th>
        </tr>
    </thead>
    <tbody>

    @forelse ($events as $event)
        <tr>
            <td>
                {{ $event?->occurred_at?->format('d/m/Y \À\S H:i') ?? '-'}}
            </td>
            <td>
                {{ $event->eventType->name }}
            </td>
            <td>
                {{ $event?->sector?->name ?? '-' }}
            </td>
            <td>
                {{ $event->dutyUser->name }}
            </td>
            <td class="text-center actions">
                <a href="{{ route('events.show', ['routine_id' => $routine_id, 'id' => $event->id, 'redirect' => $redirect, 'disabled' => true]) }}" class="btn btn-link" title="Detalhar"><i class="fa fa-search"></i></a>
                @if($routine->status)
                    <a href="{{ route('events.show', ['routine_id' => $routine_id, 'id' => $event->id, 'redirect' => $redirect]) }}" class="btn btn-link" title="Alterar"><i class="fa fa-pencil"></i></a>
                    <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#event-delete-modal{{ $event->id }}" title="Remover">
                        <i class="fa fa-trash"></i>
                    </button>
                @endif
            </td>
            <!-- Modal -->
            <div class="modal fade" id="event-delete-modal{{ $event->id }}" tabindex="-1" aria-labelledby="deleteModalLabelEvent" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabelEvent"><i class="fas fa-trash"></i> Remoção de Ocorrênciax</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="form" action="{{ route('events.destroy', ['routine_id' => $routine_id, 'id' => $event->id]) }}" method="post">
                                @csrf
                                <input type="hidden" name="redirect" value="{{ $redirect }}">
                                <div class="form-group">
                                    <label for="event_type_id">Tipo</label>
                                    <select class="form-select form-control" name="event_type_id" id="event_type_id" disabled>
                                        <option value="{{ $event->eventType?->id }}" selected="selected">{{ $event->eventType?->name }}</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="occurred_at">Data da Ocorrência</label>
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
                                    <textarea class="form-control" name="description" id="description" disabled>{{ $event->description }}</textarea>
                                </div>

                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success btn-sm text-white close-modal"><i class="fa fa-check"></i> Remover</button>
                                    <button type="button" class="btn btn-danger btn-sm text-white close-btn" data-bs-dismiss="modal"><i class="fas fa-ban"></i> Cancelar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </tr>
    @empty
        <div class="alert alert-warning mt-2">
            <i class="fa fa-exclamation-triangle"></i> Nenhuma Ocorrência encontrada.
        </div>
    @endforelse


    <div class="d-flex justify-content-center">
        {{ $events->links() }}
    </div>
    </tbody>
</table>
