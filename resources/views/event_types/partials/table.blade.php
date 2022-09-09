

<table id="eventTypeTable" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th class="col-md-1">#</th>
            <th class="col-md-9">Nome</th>
            <th class="col-md-2">Status</th>
        </tr>
    </thead>
    <tbody>
    @forelse ($eventTypes as $eventType)
        <tr>
            <td>
                <a href="{{ route('event_types.show', ['id' => $eventType['id']]) }}" title="{{ $eventType['name'] }}">{{ $eventType['id'] }}</a>
            </td>
            <td>
                {{ $eventType['name'] }}
            </td>
            <td class="text-center">
                @if ($eventType['status'])
                    <label class="badge bg-success"> Ativo </label>
                @else
                    <label class="badge bg-danger"> Inativo </label>
                @endif
            </td>
        </tr>
    @empty
        <div class="alert alert-warning mt-2">
            Nenhum Tipo de Ocorrência encontrado
        </div>
    @endforelse
    </tbody>
</table>
