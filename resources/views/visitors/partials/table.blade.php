<div class="row mb-2">
    <div class="col-md-12">
        <div class="row my-4">
            <div class="col-sm-8 align-self-center">
                <h4 class="mb-0">
                    <i class="fas fa-people-group"></i> Visitantes
                </h4>
            </div>
            <div  class="col-sm-4 align-self-center d-flex justify-content-end">
                @if($routine->status)
                    <a href="{{ route('visitors.create', ['routine_id' => $routine->id, 'redirect' => $redirect]) }}" class="btn btn-primary text-white float-end" title="Novo/a Visitante" id="newVisitor">
                        <i class="fa fa-plus"></i> Novo/a
                    </a>
                @endif
            </div>
        </div>
        @forelse ($visitors as $visitor)
            <div class="cards-striped mx-lg-0 mt-lg-2 my-2">
                <div class="card cursor-pointer">
                    <div class="card-body py-1">
                        <div class="row d-flex align-items-center">
                            <div class="col-12 col-lg-4 text-center text-lg-start">
                                <span class="fw-bold">Entrada:</span> {{ $visitor?->entranced_at?->format('d/m/Y \À\S H:i') ?? '-'}}
                            </div>
                            <div class="col-12 col-lg-4 text-center text-lg-start">
                                <span class="fw-bold">Saída:</span> @if(isset($visitor?->exited_at)) {{ $visitor?->exited_at?->format('d/m/Y \À\S H:i') }} @else <span class="badge bg-warning text-black">PENDENTE </span> @endif
                            </div>
                            <div class="col-12 col-lg-4 text-center text-lg-start">
                                <span class="fw-bold">Visitante:</span> {{ $visitor->person->name }}
                            </div>
                            <div class="col-12 col-lg-4 text-center text-lg-start">
                                <span class="fw-bold">Setor:</span> {{ $visitor?->sector?->name ?? '-' }}
                            </div>
                            <div class="col-12 col-lg-5 text-center text-lg-start">
                                <span class="fw-bold">Plantonista:</span> {{ $visitor->dutyUser->name }}
                            </div>
                            <div class="col-12 col-lg-3 text-center text-lg-end">
                                @if($visitor->hasPending())
                                    <span class="badge bg-warning text-black"><i class="fa fa-exclamation-triangle"></i> ROTINA ANTERIOR </span>
                                @endif
                                <a href="{{ route('visitors.show', ['routine_id' => $routine_id, 'visitor' => $visitor->id, 'redirect' => $redirect, 'disabled' => true]) }}" class="btn btn-link" title="Detalhar"><i class="fa fa-search"></i></a>
                                @if($routine->status)
                                    <a href="{{ route('visitors.show', ['routine_id' => $routine_id, 'visitor' => $visitor->id, 'redirect' => $redirect]) }}" class="btn btn-link" title="Alterar" id="alterarVisitor"><i class="fa fa-pencil"></i></a>
                                    @if(!$visitor->hasPending())
                                        <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#visitor-delete-modal{{ $visitor->id }}" title="Remover" id="removerVisitor">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
                                    <button type="submit" class="btn btn-success btn-sm text-white close-modal" id="submitRemoverVisitor"><i class="fa fa-check"></i> Remover</button>
                                    <button type="button" class="btn btn-danger btn-sm text-white close-btn" data-bs-dismiss="modal"><i class="fas fa-ban"></i> Cancelar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-md-12">
                <div class="alert alert-warning">
                    <i class="fa fa-exclamation-triangle"></i> Nenhum/a Visitante encontrado/a.
                </div>
            </div>
        @endforelse
    </div>
</div>
