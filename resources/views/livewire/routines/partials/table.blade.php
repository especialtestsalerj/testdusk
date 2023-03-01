

<table id="routineTable" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th class="col-md-1">Turno</th>
            <th class="col-md-4">Assunção</th>
            <th class="col-md-4">Passagem</th>
            <th class="col-md-2">Status</th>
            <th class="col-md-1"></th>
        </tr>
    </thead>
    <tbody>
    @forelse ($routines as $routine)
        <tr>
            <td>
                {{ $routine?->shift?->name }}
            </td>
            <td>
                {{ $routine?->entranced_at?->format('d/m/Y \À\S H:i') ?? '-'}}
                <br />
                {{ $routine?->entrancedUser?->name }}
            </td>
            <td>
                {{ $routine?->exited_at?->format('d/m/Y \À\S H:i') ?? '-'}}
                <br />
                {{ $routine?->entrancedUser?->name ?? '-'}}
            </td>
            <td class="text-center">
                @if ($routine->status)
                    <label class="badge bg-success"> ABERTA </label>
                    <button type="button" class="btn btn-sm btn-outline-dark" data-bs-toggle="modal" data-bs-target="#finishModal{{$routine->id}}" title="Finalizar Rotina">
                        <i class="fa fa-check"></i> Finalizar
                    </button>
                @else
                    <label class="badge bg-danger"> FINALIZADA </label>
                @endif
            </td>
            <td class="text-center">
                @if ($routine->status)
                    <a href="{{ route('routines.show', ['id' => $routine->id]) }}" class="btn btn-primary text-white" dusk="manageRoutine-{{$routine->id}}" title="Gerenciar Rotina">
                        <i class="fa fa-cog"></i> Gerenciar
                    </a>
                @else
                    <a href="{{ route('routines.show', ['id' => $routine->id]) }}" class="btn btn-primary" title="Detalhar Rotina">
                        <i class="fa fa-search"></i> Visualizar
                    </a>
                @endif
            </td>
        </tr>
        <!-- Modal -->
        <div class="modal fade" id="finishModal{{$routine->id}}" tabindex="-1" aria-labelledby="finishModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="finishModalLabel"><i class="fas fa-check"></i> Finalizar Rotina</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="form" action="{{ route('routines.finish', ['id' => $routine->id]) }}" method="post">
                            @csrf

                            <p class="text-end">* Campos obrigatórios</p>

                            <div class="form-group">
                                <label for="exited_at">Data (Passagem)*</label>
                                <input type="datetime-local" max="3000-01-01T23:59" class="form-control text-uppercase" name="exited_at" id="exited_at" value="{{is_null(old('exited_at')) ? $routine->exited_at?->format('Y-m-d H:i') : old('exited_at')}}"/>
                            </div>
                            <div class="form-group">
                                <label for="exited_user_id">Responsável (Passagem)*</label>
                                <select class="form-select form-control" name="exited_user_id" id="exited_user_id">
                                    <option value="">SELECIONE</option>
                                    @foreach ($exitedUsers as $key => $user)
                                        @if(((!is_null($routine->id)) && (!is_null($routine->exited_user_id) && $routine->exited_user_id === $user->id) || (!is_null(old('exited_user_id'))) && old('exited_user_id') == $user->id))
                                            <option value="{{ $user->id }}" selected="selected">{{ $user->name }}</option>
                                        @else
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-outline-success btn-sm close-modal"><i class="fa fa-save" dusk="finishRoutine"></i> Finalizar</button>
                                <button type="button" class="btn btn-outline-danger btn-sm close-btn" data-bs-dismiss="modal"><i class="fas fa-ban"></i> Cancelar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="alert alert-warning mt-2">
            <i class="fa fa-exclamation-triangle"></i> Nenhuma Rotina encontrada.
        </div>
    @endforelse
    <div class="d-flex justify-content-center">
        {{ $routines->links() }}
    </div>
    </tbody>
</table>
