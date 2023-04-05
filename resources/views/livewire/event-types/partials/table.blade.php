<div class="row">
    <div class="col-md-12">
        @forelse ($eventTypes as $eventType)
            <div class="cards-striped mx-lg-0 mt-lg-2 my-2">
                <div class="card">
                    <div class="card-body py-1">
                        <div class="row d-flex align-items-center">
                            <div class="col-12 col-lg-8 text-center text-lg-start">
                                <span class="fw-bold">Nome:</span> {{ $eventType->name }}
                            </div>
                            <div class="col-12 col-lg-2 text-center text-lg-start">
                                <span class="fw-bold">Status:</span>
                                @if ($eventType->status)
                                    <label class="badge bg-success"> ATIVO </label>
                                @else
                                    <label class="badge bg-danger"> INATIVO </label>
                                @endif
                            </div>
                            <div class="col-12 col-lg-2 text-center text-lg-end">
                                <a href="{{ route('event-types.show', ['id' => $eventType->id]) }}" class="btn btn-link" title="Alterar"><i class="fa fa-pencil"></i></a>
                                @if(!$eventType->canDelete())
                                    <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#event-type-delete-modal{{ $eventType->id }}" title="Remover">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="event-type-delete-modal{{ $eventType->id }}" tabindex="-1" aria-labelledby="deleteModalLabelEventType" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabelEventType"><i class="fas fa-trash"></i> Remoção de Tipo de Ocorrência</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="form" action="{{ route('event-types.destroy', ['id' => $eventType->id]) }}" method="post">
                                @csrf
                                <input name="id" type="hidden" value="{{ $eventType->id }}">
                                <div class="form-group">
                                    <label for="name">Nome</label>
                                    <input class="form-control" name="name" id="name" value="{{ $eventType->name }}" disabled/>
                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-select form-control" name="status" id="status" disabled>
                                        <option value="{{ $eventType->status }}" selected="selected">{{ ($eventType->status ? 'ATIVO' : 'INATIVO') }}</option>
                                    </select>
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
        @empty
            <div class="alert alert-warning mt-2">
                <i class="fa fa-exclamation-triangle"></i> Nenhum Tipo de Ocorrência encontrado.
            </div>
        @endforelse
        <div class="d-flex justify-content-center mt-2">
            {{ $eventTypes->links() }}
        </div>
    </div>
</div>
