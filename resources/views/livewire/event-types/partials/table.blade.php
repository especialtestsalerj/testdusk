


<table id="eventTypeTable" class="table table-striped table-bordered">
    <thead>
    <tr>
        <th class="col-md-8">Nome</th>
        <th class="col-md-2">Status</th>
        <th class="col-md-2"></th>
    </tr>
    </thead>
    <tbody>
    @forelse ($eventTypes as $eventType)
        <tr>
            <td>
                {{ $eventType->name }}
            </td>
            <td class="text-center">
                @if ($eventType->status)
                    <label class="badge bg-success"> ATIVO </label>
                @else
                    <label class="badge bg-danger"> INATIVO </label>
                @endif
            </td>
            <td class="text-center actions">
                <a href="{{ route('event-types.show', ['id' => $eventType->id]) }}" class="btn btn-link" title="Alterar"><i class="fa fa-pencil"></i></a>
                @if(!$eventType->canDelete())
                    <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#delete-modal{{ $eventType->id }}" title="Remover">
                        <i class="fa fa-trash"></i>
                    </button>
                @endif
            </td>
            <!-- Modal -->
            <div class="modal fade" id="delete-modal{{ $eventType->id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel"><i class="fas fa-trash"></i> Remoção de Tipo de Ocorrência</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="form" action="{{ route('event-types.delete', ['id' => $eventType->id]) }}" method="post">
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
                                    <button type="submit" class="btn btn-outline-success btn-sm close-modal"><i class="fa fa-save"></i> Confirmar</button>
                                    <button type="button" class="btn btn-outline-danger btn-sm close-btn" data-bs-dismiss="modal"><i class="fas fa-ban"></i> Cancelar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </tr>
    @empty
        <div class="alert alert-warning mt-2">
            <i class="fa fa-exclamation-triangle"></i> Nenhum Tipo de Ocorrência encontrado.
        </div>
    @endforelse
    <div class="d-flex justify-content-center">
        {{ $eventTypes->links() }}
    </div>
    </tbody>
</table>
