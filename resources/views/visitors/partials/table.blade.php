<div class="row mt-4">
    <div class="col-md-12">
        <div class="row">
            <div class="col-sm-8 align-self-center">
                <h4 class="mb-0">
                    <i class="fas fa-people-group"></i> Visitantes
                </h4>
            </div>

            <div class="col-sm-4 align-self-center d-flex justify-content-end">
                <a id="novo" href="{{ route('visitors.create', $routine->id) }}" class="btn btn-outline-primary float-end" title="Novo/a Visitante">
                    <i class="fa fa-plus"></i> Novo/a
                </a>
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
                    <td class="text-center">
                        <a href="{{ route('visitors.show', ['id' => $visitor['id']]) }}" title="{{ $visitor['entranced_at'] }}"><i class="fa fa-search"></i></a>

                        &nbsp;&nbsp;
                        <a href="{{ route('visitors.show', ['id' => $visitor['id']]) }}" title="{{ $visitor['entranced_at'] }}"><i class="fa fa-pencil"></i></a>
                    </td>
                </tr>
            @empty
                <div class="alert alert-warning mt-2">
                    Nenhum/a Visitante encontrado/a
                </div>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
