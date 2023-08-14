<div class="row">
    <div class="col-md-12">
        <div class="row my-4">
            <div class="col-sm-8 align-self-center">
                <h4 class="mb-0">
                    <i class="fas fa-gun"></i> Cautelas de Armas
                </h4>
            </div>
            <div class="col-sm-4 align-self-center d-flex justify-content-end">
                @if($routine->status)
                    <a href="{{ route('cautions.create', ['routine_id' => $routine->id, 'redirect' => $redirect]) }}" class="btn btn-primary text-white float-end" title="Nova Cautela" dusk="newCaution" id="newCaution" >
                        <i class="fa fa-plus"></i> Nova
                    </a>
                @endif
            </div>
        </div>
        @forelse ($cautions as $caution)
            <div class="cards-striped mx-lg-0 mt-lg-2 my-2">
                <div class="card cursor-pointer">
                    <div class="card-body py-1">
                        <div class="row d-flex align-items-center">
                            <div class="col-12 col-lg-2 text-center text-lg-start">
                                <span class="fw-bold">Protocolo:</span> {{ $caution?->protocol_number_formatted ?? '-' }}
                            </div>
                            <div class="col-12 col-lg-3 text-center text-lg-start">
                                <span class="fw-bold">Abertura:</span> {{ $caution?->started_at?->format('d/m/Y \À\S H:i') ?? '-' }}
                            </div>
                            <div class="col-12 col-lg-3 text-center text-lg-start">
                                <span class="fw-bold">Fechamento:</span> @if(isset($caution?->concluded_at)) {{ $caution?->concluded_at?->format('d/m/Y \À\S H:i') }} @else <span class="badge bg-warning text-black">PENDENTE </span> @endif
                            </div>
                            <div class="col-12 col-lg-4 text-center text-lg-start">
                                <span class="fw-bold">Solicitante:</span> {{ $caution->visitor->person->name }}
                            </div>
                            <div class="col-12 col-lg-4 text-center text-lg-start">
                                <span class="fw-bold">Destino:</span> {{ $caution->visitor?->sector?->name }}
                            </div>
                            <div class="col-12 col-lg-4 text-center text-lg-start">
                                <span class="fw-bold">Plantonista:</span> {{ $caution->dutyUser->name }}
                            </div>
                            <div class="col-12 col-lg-4 text-center text-lg-end">
                                @if(!$caution->hasWeapons())
                                    <span class="badge bg-danger text-white"><i class="fa fa-exclamation-triangle"></i> SEM ARMA(S) </span>
                                @endif
                                @if($caution->hasPending())
                                    <span class="badge bg-warning text-black"><i class="fa fa-exclamation-triangle"></i> ROTINA ANTERIOR </span>
                                @endif
                                <a href="{{ route('cautions.receipt', ['routine_id' => $routine->id, 'id' => $caution->id, 'redirect' => $redirect]) }}" class="btn btn-link" title="Gerar comprovante"><i class="fa fa-print"></i></a>
                                <a href="{{ route('cautions.show', ['routine_id' => $routine_id, 'id' => $caution->id, 'redirect' => $redirect, 'disabled' => true]) }}" class="btn btn-link" title="Detalhar"><i class="fa fa-search"></i></a>
                                @if($routine->status)
                                    <a href="{{ route('cautions.show', ['routine_id' => $routine_id, 'id' => $caution->id, 'redirect' => $redirect]) }}" class="btn btn-link" title="Alterar" id="editCautela"><i class="fa fa-pencil"></i></a>
                                    @if(!$caution->hasPending())
                                        <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#caution-delete-modal{{ $caution->id }}" title="Remover" id="removeCautela">
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
            <div class="modal fade" id="caution-delete-modal{{ $caution->id }}" tabindex="-1" aria-labelledby="deleteModalLabelCaution" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabelCaution"><i class="fas fa-trash"></i> Remoção de Cautela</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="form" action="{{ route('cautions.destroy', ['routine_id' => $routine_id, 'id' => $caution->id]) }}" method="post">
                                @csrf
                                <input type="hidden" name="redirect" value="{{ $redirect }}">
                                <div class="form-group">
                                    <label for="protocol_number">Protocolo</label>
                                    <input type="text" class="form-control text-uppercase" name="protocol_number" id="protocol_number" value="{{ $caution?->protocol_number_formatted }}" disabled/>
                                </div>
                                <div class="form-group">
                                    <label for="started_at">Data da Abertura</label>
                                    <input type="datetime-local" max="3000-01-01T23:59" class="form-control text-uppercase" name="started_at" id="started_at" value="{{ $caution->started_at }}" disabled/>
                                </div>
                                <div class="form-group">
                                    <label for="concluded_at">Data da Fechamento</label>
                                    <input type="datetime-local" max="3000-01-01T23:59" class="form-control text-uppercase" name="concluded_at" id="concluded_at" value="{{ $caution->concluded_at }}" disabled/>
                                </div>
                                <div class="form-group">
                                    <label for="visitor">Visitante</label>
                                    <input type="text" class="form-control text-uppercase" name="visitor" id="visitor" value="{{ $caution?->visitor->person->name }}" disabled/>
                                </div>
                                <div class="form-group">
                                    <label for="sector_id">Destino</label>
                                    <select class="form-select form-control" name="sector_name" id="sector_id" disabled>
                                        <option value="{{ $caution->visitor?->sector?->name }}" selected="selected">{{ $caution->visitor?->sector?->name }}</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="duty_user_id">Plantonista</label>
                                    <select class="form-select form-control" name="duty_user_id" id="duty_user_id" disabled>
                                        <option value="{{ $caution->dutyUser?->id }}" selected="selected">{{ $caution->dutyUser?->name }}</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="description">Observações</label>
                                    <textarea class="form-control" name="description" id="description" disabled>{{ $caution->description }}</textarea>
                                </div>

                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success btn-sm text-white close-modal" id="removerCautela"><i class="fa fa-check"></i> Remover</button>
                                    <button type="button" class="btn btn-danger btn-sm text-white close-btn" data-bs-dismiss="modal"><i class="fas fa-ban"></i> Cancelar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="alert alert-warning mt-2">
                <i class="fa fa-exclamation-triangle"></i> Nenhuma Cautela encontrada.
            </div>
        @endforelse
    </div>
</div>
