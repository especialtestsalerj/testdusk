<div class="row mt-4">
    <div class="col-md-12">
        <div class="row">
            <div class="col-sm-8 align-self-center">
                <h4 class="mb-0">
                    <i class="fas fa-dolly-box"></i> Materiais
                </h4>
            </div>

            <div class="col-sm-4 align-self-center d-flex justify-content-end">
                @if($routine->status)
                <a href="{{ route('stuffs.create', $routine->id) }}" class="btn btn-outline-primary text-white float-end" dusk="newStuff" title="Novo Material">
                    <i class="fa fa-plus"></i> Novo
                </a>
                @endif
            </div>
        </div>

        <table id="stuffTable" class="table table-striped table-bordered mt-2">
            <thead>
            <tr>
                <th class="col-md-2">Entrada</th>
                <th class="col-md-2">Saída</th>
                <th class="col-md-2">Setor</th>
                <th class="col-md-4">Plantonista</th>
                <th class="col-md-2"></th>
            </tr>
            </thead>
            <tbody>
            @forelse ($stuffs as $stuff)
                <tr>
                    <td>
                        {{ $stuff?->entranced_at?->format('d/m/Y \À\S H:i') ?? '-'}}
                    </td>
                    <td>
                        {{ $stuff?->exited_at?->format('d/m/Y \À\S H:i') ?? '-'}}
                    </td>
                    <td>
                        {{ $stuff?->sector?->name ?? '-' }}
                    </td>
                    <td>
                        {{ $stuff->dutyUser->name }}
                    </td>
                    <td class="text-center actions">
                        <a href="{{ route('stuffs.show', ['id' => $stuff->id, 'disabled' => true]) }}" class="btn btn-link" title="Detalhar"><i class="fa fa-search"></i></a>
                        @if($routine->status)
                            <a href="{{ route('stuffs.show', ['id' => $stuff->id]) }}" class="btn btn-link" title="Alterar"><i class="fa fa-pencil"></i></a>
                            <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#delete-modal{{ $stuff->id }}" title="Remover">
                                <i class="fa fa-trash"></i>
                            </button>
                        @endif
                    </td>
                    <!-- Modal -->
                    <div class="modal fade" id="delete-modal{{ $stuff->id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel"><i class="fas fa-trash"></i> Remoção de Material</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="form" action="{{ route('stuffs.delete', ['id' => $stuff->id]) }}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label for="entranced_at">Entrada</label>
                                            <input type="datetime-local" max="3000-01-01T23:59" class="form-control text-uppercase" name="entranced_at" id="entranced_at" value="{{ $stuff->entranced_at }}" disabled/>
                                        </div>
                                        <div class="form-group">
                                            <label for="exited_at">Saída</label>
                                            <input type="datetime-local" max="3000-01-01T23:59" class="form-control text-uppercase" name="exited_at" id="exited_at" value="{{ $stuff->exited_at }}" disabled/>
                                        </div>
                                        <div class="form-group">
                                            <label for="sector_id">Setor</label>
                                            <select class="form-select form-control" name="sector_id" id="sector_id" disabled>
                                                <option value="{{ $stuff->sector?->id }}" selected="selected">{{ $stuff->sector?->name }}</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="duty_user_id">Plantonista</label>
                                            <select class="form-select form-control" name="duty_user_id" id="duty_user_id" disabled>
                                                <option value="{{ $stuff->dutyUser?->id }}" selected="selected">{{ $stuff->dutyUser?->name }}</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="description">Observações</label>
                                            <textarea class="form-control" name="description" id="description" disabled>{{ $stuff->description }}</textarea>
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
                    <i class="fa fa-exclamation-triangle"></i> Nenhum Material encontrado.
                </div>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
