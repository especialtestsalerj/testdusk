<div class="row mt-4">
    <div class="col-md-12">
        <div class="row">
            <div class="col-sm-8 align-self-center">
                <h4 class="mb-0">
                    <i class="fas fa-people-group"></i> Visitantes
                </h4>
            </div>

            <div class="col-sm-4 align-self-center d-flex justify-content-end">
                @if($routine->status)
                <a href="{{ route('visitors.create', ['routine_id' => $routine->id, 'redirect' => $redirect]) }}" class="btn btn-primary text-white float-end" title="Novo/a Visitante" dusk="newVisitors">
                    <i class="fa fa-plus"></i> Novo/a
                </a>
                @endif
            </div>
        </div>

        <table id="visitorTable" class="table table-striped table-bordered mt-2">
            <thead>
            <tr>
                <th class="col-md-2">Entrada</th>
                <th class="col-md-2">Saída</th>
                <th class="col-md-2">Visitante</th>
                <th class="col-md-2">Setor</th>
                <th class="col-md-2">Plantonista</th>
                <th class="col-md-2"></th>
            </tr>
            </thead>
            <tbody>
            @forelse ($visitors as $visitor)
                <tr>
                    <td>
                        {{ $visitor?->entranced_at?->format('d/m/Y \À\S H:i') ?? '-'}}
                    </td>
                    <td>
                        {{ $visitor?->exited_at?->format('d/m/Y \À\S H:i') ?? '-'}}
                    </td>
                    <td>
                        {{ $visitor->person->full_name }}
                    </td>
                    <td>
                        {{ $visitor?->sector?->name ?? '-' }}
                    </td>
                    <td>
                        {{ $visitor->dutyUser->name }}
                    </td>
                    <td class="text-center actions">
                        <a href="{{ route('visitors.show', ['routine_id' => $routine->id, 'id' => $visitor->id, 'redirect' => $redirect, 'disabled' => true]) }}" class="btn btn-link" title="Detalhar"><i class="fa fa-search"></i></a>
                        @if($routine->status)
                            <a href="{{ route('visitors.show', ['routine_id' => $routine->id, 'id' => $visitor->id, 'redirect' => $redirect]) }}" class="btn btn-link" title="Alterar"><i class="fa fa-pencil"></i></a>
                            <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#visitor-delete-modal{{ $visitor->id }}" title="Remover">
                                <i class="fa fa-trash"></i>
                            </button>
                        @endif
                    </td>
                    <!-- Modal -->
                    <div class="modal fade" id="visitor-delete-modal{{ $visitor->id }}" tabindex="-1" aria-labelledby="deleteModalLabelVisitor" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabelVisitor"><i class="fas fa-trash"></i> Remoção de Visitante</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="form" action="{{ route('visitors.destroy', ['routine_id' => $routine_id, 'id' => $visitor->id]) }}" method="post">
                                        @csrf
                                        <input type="hidden" name="redirect" value="{{ $redirect }}">
                                        <div class="form-group">
                                            <label for="entranced_at">Entrada</label>
                                            <input type="datetime-local" max="3000-01-01T23:59" class="form-control text-uppercase" name="entranced_at" id="entranced_at" value="{{ $visitor->entranced_at }}" disabled/>
                                        </div>
                                        <div class="form-group">
                                            <label for="exited_at">Saída</label>
                                            <input type="datetime-local" max="3000-01-01T23:59" class="form-control text-uppercase" name="exited_at" id="exited_at" value="{{ $visitor->exited_at }}" disabled/>
                                        </div>
                                        @livewire('people.people', ['person' => $visitor->person, 'routineStatus' => $routine->status, 'mode' => formMode(), 'modal' => true])
                                        <div class="form-group">
                                            <label for="sector_id">Setor</label>
                                            <select class="form-select form-control" name="sector_id" id="sector_id" disabled>
                                                <option value="{{ $visitor->sector?->id }}" selected="selected">{{ $visitor->sector?->name }}</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="duty_user_id">Plantonista</label>
                                            <select class="form-select form-control" name="duty_user_id" id="duty_user_id" disabled>
                                                <option value="{{ $visitor->dutyUser?->id }}" selected="selected">{{ $visitor->dutyUser?->name }}</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="description">Observações</label>
                                            <textarea class="form-control" name="description" id="description" disabled>{{ $visitor->description }}</textarea>
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
                    <i class="fa fa-exclamation-triangle"></i> Nenhum/a Visitante encontrado/a.
                </div>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
