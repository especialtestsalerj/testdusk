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
                <a href="{{ route('stuffs.create', $routine->id) }}" class="btn btn-primary float-end" dusk="newStuff" title="Novo/a Material">
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
                    <td class="text-center">
                        <a href="{{ route('stuffs.show', ['id' => $stuff['id']]) }}" title="{{ $stuff['entranced_at'] }}"><i class="fa fa-search"></i></a>
                        @if($routine->status)
                        <a href="{{ route('stuffs.show', ['id' => $stuff['id']]) }}" title="{{ $stuff['entranced_at'] }}"><i class="fa fa-pencil"></i></a>
                        @endif
                    </td>
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
