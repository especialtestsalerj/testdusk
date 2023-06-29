<div class="row">
    <div class="col-md-12">
        @if(!empty($people))
            <table class="table-dynamic table table-striped">
                <thead>
                <tr>
                    <td class="col-md-6">Nome</td>
                    <td class="col-md-5">Documento(s)</td>
                    <td class="col-md-1"></td>
                </tr>
                </thead>
                <tbody>
                @endif
        @forelse ($people as $person)
            <tr>
                <td data-label="Nome">
                    {{ $person->name}}
                    @if($person->hasPendingVisitors())
                        <span class="badge bg-warning text-black">Visita em aberto</span>
                    @endif
                </td>
                <td data-label="Documento(s)">
                    @foreach($person->documents as $document)
                        <span class="fw-bold">{{$document->documentType->name}}</span> : {{$document->number}}
                        @if($document->state?->initial)
                            - {{$document->state->initial}}
                        @endif
                        &nbsp;
                    @endforeach</td>
                <td class="actions">
                    <a href="#" class="btn btn-link" title="Detalhar"><i class="fa fa-search"></i></a>
                    <a href="#" class="btn btn-link" title="Alterar"><i class="fa fa-pencil"></i></a>
                    <a href="#" class="btn btn-link" title="Imprimir Etiqueta"><i class="fa fa-print"></i></a>
                </td>
            </tr>
        @empty
            <div class="alert alert-warning mt-2">
                <i class="fa fa-exclamation-triangle"></i> Nenhuma Pessoa encontrada.
            </div>
        @endforelse
        @if(!empty($people))
                </tbody>
            </table>
        @endif
        <div class="d-flex justify-content-center mt-2">
            {{ $people->links() }}
        </div>
    </div>
</div>
