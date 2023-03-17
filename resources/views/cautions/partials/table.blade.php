<div class="row mt-4">
    <div class="col-md-12">
        <div class="row">
            <div class="col-sm-8 align-self-center">
                <h4 class="mb-0">
                    <i class="fas fa-gun"></i> Cautelas de Armas
                </h4>
            </div>

            <div class="col-sm-4 align-self-center d-flex justify-content-end">
                @if($routine->status)
                <a href="{{ route('cautions.create', $routine->id) }}" class="btn btn-primary text-white float-end" dusk="newCaution" title="Nova Cautela">
                    <i class="fa fa-plus"></i> Nova
                </a>
                @endif
            </div>
        </div>



        <div class="cards-striped mx-3 mx-lg-0 mt-lg-4">

            <div class="card card-routine m-1">
                <div class="card-body py-1">
                    <div class="row d-flex align-items-center">
                        <div class="col-12 col-lg-1 text-center text-lg-start">
                            <div class="row">
                                <div class="col-6 col-lg-12 fw-bold">Protocolo :</div>
                                <div class="col-6 col-lg-12 fw-bold">14/02/2023 ÀS 17:32</div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-1 text-center text-lg-start">
                            <div class="row">
                                <div class="col-6 col-lg-12 fw-bold">Abertura</div>
                                <div class="col-6 col-lg-12 fw-bold">14/02/2023 ÀS 17:32</div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-2 text-center text-lg-start">
                            <div class="row">
                                <div class="col-6 col-lg-12 fw-bold">Fechamento :</div>
                                <div class="col-6 col-lg-12 fw-bold">14/02/2023 ÀS 17:32</div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-2 text-center text-lg-start">
                            <div class="row">
                                <div class="col-6 col-lg-12 fw-bold">Solicitante :</div>
                                <div class="col-6 col-lg-12 fw-bold">Novo Solicitante</div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-2 text-center text-lg-start">
                            <div class="row">
                                <div class="col-6 col-lg-12 fw-bold">Destino :</div>
                                <div class="col-6 col-lg-12 fw-bold">Nome do Destino</div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-2 text-center text-lg-start">
                            <div class="row">
                                <div class="col-6 col-lg-12 fw-bold">Plantonista :</div>
                                <div class="col-6 col-lg-12 fw-bold">Nome do Plantonista</div>
                            </div>
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




        <table id="cautionTable" class="table table-striped table-bordered mt-2">
            <thead>
            <tr>
                <th class="col-md-1">Protocolo</th>
                <th class="col-md-2">Abertura</th>
                <th class="col-md-2">Fechamento</th>
                <th class="col-md-2">Solicitante</th>
                <th class="col-md-1">Destino</th>
                <th class="col-md-2">Plantonista</th>
                <th class="col-md-2"></th>
            </tr>
            </thead>
            <tbody>
            @forelse ($cautions as $caution)
                <tr>
                    <td>
                        {{ $caution?->protocol_number_formatted ?? '-' }}
                    </td>
                    <td>
                        {{ $caution?->started_at?->format('d/m/Y \À\S H:i') ?? '-'}}
                    </td>
                    <td>
                        {{ $caution?->concluded_at?->format('d/m/Y \À\S H:i') ?? '-'}}
                    </td>
                    <td>
                        {{ $caution->visitor->person->full_name }}
                    </td>
                    <td>
                        {{ $caution->destinySector->name }}
                    </td>
                    <td>
                        {{ $caution->dutyUser->name }}
                    </td>
                    <td class="text-center actions">
                        <a href="{{ route('cautions.show', ['id' => $caution->id, 'disabled' => true]) }}" class="btn btn-link" title="Detalhar"><i class="fa fa-search"></i></a>
                        @if($routine->status)
                            <a href="{{ route('cautions.show', ['id' => $caution->id]) }}" class="btn btn-link" title="Alterar"><i class="fa fa-pencil"></i></a>
                            <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#delete-modal-caution{{ $caution->id }}" title="Remover">
                                <i class="fa fa-trash"></i>
                            </button>
                        @endif
                    </td>
                    <!-- Modal -->
                    <div class="modal fade" id="delete-modal-caution{{ $caution->id }}" tabindex="-1" aria-labelledby="deleteModalLabelCaution" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabelCaution"><i class="fas fa-trash"></i> Remoção de Cautela</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="form" action="{{ route('cautions.delete', ['id' => $caution->id]) }}" method="post">
                                        @csrf

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
                                            <input type="text" class="form-control text-uppercase" name="visitor" id="visitor" value="{{ $caution?->visitor->person->full_name }}" disabled/>
                                        </div>
                                        <div class="form-group">
                                            <label for="sector_id">Destino</label>
                                            <select class="form-select form-control" name="sector_id" id="sector_id" disabled>
                                                <option value="{{ $caution->destinySector?->id }}" selected="selected">{{ $caution->destinySector?->name }}</option>
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
                    <i class="fa fa-exclamation-triangle"></i> Nenhuma Cautela encontrada.
                </div>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
