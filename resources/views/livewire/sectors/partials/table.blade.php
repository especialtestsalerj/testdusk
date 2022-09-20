

<table id="sectorTable" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th class="col-md-1">#</th>
            <th class="col-md-9">Nome</th>
            <th class="col-md-2">Status</th>
        </tr>
    </thead>
    <tbody>
    @forelse ($sectors as $sector)
        <tr>
            <td>
                <a href="{{ route('sectors.show', ['id' => $sector['id']]) }}" dusk="sector-{{ $sector['id'] }}" title="{{ $sector['name'] }}">{{ $sector['id'] }}</a>
            </td>
            <td>
                {{ $sector['name'] }}
            </td>
            <td class="text-center">
                @if ($sector['status'])
                    <label class="badge bg-success"> ATIVO </label>
                @else
                    <label class="badge bg-danger"> INATIVO </label>
                @endif
            </td>
        </tr>
    @empty
        <div class="alert alert-warning mt-2">
            <i class="fa fa-exclamation-triangle"></i> Nenhum Setor encontrado.
        </div>
    @endforelse
    <div class="d-flex justify-content-center">
        {{ $sectors->links() }}
    </div>
    </tbody>
</table>
