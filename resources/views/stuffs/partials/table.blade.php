<div class="row mt-4">
    <div class="col-md-12">
        <div class="row">
            <div class="col-sm-8 align-self-center">
                <h4 class="mb-0">
                    <i class="fas fa-dolly-box"></i> Materiais
                </h4>
            </div>

            <div class="col-sm-4 align-self-center d-flex justify-content-end">
                <a id="novo" href="{{ route('stuffs.create', $routine->id) }}" class="btn btn-outline-primary float-end" title="Novo/a Visitante">
                    <i class="fa fa-plus"></i> Novo/a
                </a>
            </div>
        </div>

        <table id="stuffTable" class="table table-striped table-bordered mt-2">
            <thead>
            <tr>
                <th class="col-md-2">Entrada</th>
                <th class="col-md-2">Saída</th>
                <th class="col-md-6">Plantonista</th>
                <th class="col-md-2"></th>
            </tr>
            </thead>
            <tbody>
            @forelse ($stuffs as $stuff)
                <tr>
                    <td>
                        {{ $stuff?->entranced_at?->format('d/m/Y \à\s H:i') ?? '-'}}
                    </td>
                    <td>
                        {{ $stuff?->exited_at?->format('d/m/Y \à\s H:i') ?? '-'}}
                    </td>
                    <td>
                        {{ $stuff->dutyUser->name }}
                    </td>
                    <td class="text-center">
                        <a href="{{ route('stuffs.show', ['id' => $stuff['id']]) }}" title="{{ $stuff['entranced_at'] }}"><i class="fa fa-search"></i></a>

                        &nbsp;&nbsp;
                        <a href="{{ route('stuffs.show', ['id' => $stuff['id']]) }}" title="{{ $stuff['entranced_at'] }}"><i class="fa fa-pencil"></i></a>
                    </td>
                </tr>
            @empty
                <div class="alert alert-warning mt-2">
                    Nenhum Material encontrado
                </div>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
