<div class="row mt-4">
    <div class="col-md-12">
        <div class="row">
            <div class="col-sm-8 align-self-center">
                <h4 class="mb-0">
                    <i class="fas fa-list-check"></i> Ocorrências
                </h4>
            </div>

            <div class="col-sm-4 align-self-center d-flex justify-content-end">
                @if($routine->status)
                <a href="{{ route('events.create', $routine->id) }}" class="btn btn-primary text-white float-end" title="Nova Ocorrência" dusk="newEvent">
                    <i class="fa fa-plus"></i> Nova
                </a>
                @endif
            </div>
        </div>

        <table id="eventTable" class="table table-striped table-bordered mt-2">
            <thead>
            <tr>
                <th class="col-md-2">Data/Hora</th>
                <th class="col-md-3">Tipo</th>
                <th class="col-md-2">Setor</th>
                <th class="col-md-3">Plantonista</th>
                <th class="col-md-2"></th>
            </tr>
            </thead>
            <tbody>
            @forelse ($events as $event)
                <tr>
                    <td>
                        {{ $event?->occurred_at?->format('d/m/Y \À\S H:i') ?? '-'}}
                    </td>
                    <td>
                        {{ $event->eventType->name }}
                    </td>
                    <td>
                        {{ $event?->sector?->name ?? '-' }}
                    </td>
                    <td>
                        {{ $event->dutyUser->name }}
                    </td>
                    <td class="text-center">
                        <a href="{{ route('events.show', ['id' => $event['id']]) }}" title="{{ $event['occurred_at'] }}"><i class="fa fa-search"></i></a>
                        @if($routine->status)
                        <a href="{{ route('events.show', ['id' => $event['id']]) }}" title="{{ $event['occurred_at'] }}"><i class="fa fa-pencil"></i></a>
                        @endif
                    </td>
                </tr>
            @empty
                <div class="alert alert-warning mt-2">
                    <i class="fa fa-exclamation-triangle"></i> Nenhuma Ocorrência encontrada.
                </div>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
