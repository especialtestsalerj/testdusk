@if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
@endif

@if(session()->has('warning'))
    <div class="alert alert-warning">
        {{ session()->get('warning') }}
    </div>
@endif

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
                <a href="{{ route('sectors.show', ['id' => $sector['id']]) }}" title="{{ $sector['name'] }}">{{ $sector['id'] }}</a>
            </td>
            <td>
                {{ $sector['name'] }}
            </td>
            <td class="text-center">
                @if ($sector['status'])
                    <label class="badge bg-success"> Ativo </label>
                @else
                    <label class="badge bg-danger"> Inativo </label>
                @endif
            </td>
        </tr>
    @empty
        <div class="alert alert-warning mt-2">
            Nenhum Setor encontrado
        </div>
    @endforelse
    </tbody>
</table>
