<div class="row mt-4">
    <div class="col-md-12">
        <div class="row">
            <div class="col-sm-8 align-self-center">
                <h4 class="mb-0">
                    <i class="fas fa-gun"></i> Cautelas de Armas
                </h4>
            </div>

            <div class="col-sm-4 align-self-center d-flex justify-content-end">
                <a id="novo" href="{{ route('cautions.create', $routine->id) }}" class="btn btn-outline-primary float-end" title="Nova Cautela">
                    <i class="fa fa-plus"></i> Nova
                </a>
            </div>
        </div>

        <table id="cautionTable" class="table table-striped table-bordered mt-2">
            <thead>
            <tr>
                <th class="col-md-1">Protocolo</th>
                <th class="col-md-2">Abertura</th>
                <th class="col-md-2">Fechamento</th>
                <th class="col-md-2">Solicitante</th>
                <th class="col-md-2">Destino</th>
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
                        {{ $caution?->started_at?->format('d/m/Y \à\s H:i') ?? '-'}}
                    </td>
                    <td>
                        {{ $caution?->concluded_at?->format('d/m/Y \à\s H:i') ?? '-'}}
                    </td>
                    <td>
                        {{ $caution->person->full_name }}
                    </td>
                    <td>
                        {{ $caution->destinySector->name }}
                    </td>
                    <td>
                        {{ $caution->dutyUser->name }}
                    </td>
                    <td class="text-center">
                        <a href="{{ route('cautions.show', ['id' => $caution['id']]) }}" title="{{ $caution['entranced_at'] }}"><i class="fa fa-search"></i></a>

                        &nbsp;&nbsp;
                        <a href="{{ route('cautions.show', ['id' => $caution['id']]) }}" title="{{ $caution['entranced_at'] }}"><i class="fa fa-pencil"></i></a>
                    </td>
                </tr>
            @empty
                <div class="alert alert-warning mt-2">
                    Nenhuma Cautela encontrada
                </div>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
