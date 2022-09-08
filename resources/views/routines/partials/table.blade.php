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

<table id="routineTable" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th class="col-md-1">#</th>
            <th class="col-md-2">Turno</th>
            <th class="col-md-2">Assunção</th>
            <th class="col-md-4">Responsável</th>
            <th class="col-md-2">Passagem</th>
            <th class="col-md-1"></th>
        </tr>
    </thead>
    <tbody>
    @forelse ($routines as $routine)
        <tr>
            <td>
                <a href="{{ route('routines.show', ['id' => $routine['id']]) }}" title="{{ $routine['entranced_at'] }}">{{ $routine['id'] }}</a>
            </td>
            <td>
                {{ $routine?->shift?->name }}
            </td>
            <td>
                {{ $routine?->entranced_at?->format('d/m/Y \à\s H:i') ?? '-'}}
            </td>
            <td>
                {{ $routine?->entrancedUser?->name }}
            </td>
            <td>
                {{ $routine?->exited_at?->format('d/m/Y \à\s H:i') ?? '-'}}
            </td>
            <td>
                <a id="novo" href="{{ route('routines.show', ['id' => $routine['id']]) }}" class="btn btn-primary" title="Gerenciar rotina">
                    <i class="fa fa-cog"></i> Gerenciar
                </a>
            </td>
        </tr>
    @empty
        <div class="alert alert-warning mt-2">
            Nenhuma Rotina encontrada
        </div>
    @endforelse
    </tbody>
</table>
