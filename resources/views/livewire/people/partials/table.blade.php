<div class="row">
    <div class="col-md-12">
        @if(!empty($people))
            <table class="table-dynamic table table-striped">
                <thead>
                <tr>
                    <td class="col-md-1">Foto</td>
                    <td class="col-md-5">Nome</td>
                    <td class="col-md-4">Documento(s)</td>
                    <td class="col-md-2"></td>
                </tr>
                </thead>
                <tbody>
                @endif
        @forelse ($people as $person)
            <tr>
                <td data-label="Foto">
                    <img class="w-75" src="{{$person->photo}}">
                </td>
                <td data-label="Nome">
                    {{ $person->name}}
                    @if($person->hasPendingVisitors())
                        <span class="badge bg-warning text-black">Visita em aberto</span>
                    @endif
                </td>
                <td data-label="Documento(s)">
                    @foreach($person->documents as $document)
                        <span class="fw-bold">{{$document->documentType->name}}</span>: {{$document->number}}
                        @if($document->state?->initial)
                            - {{$document->state->initial}}
                        @endif
                        &nbsp;
                    @endforeach</td>
                <td class="actions">
                    @if($person->hasPendingVisitors())
                        <span class="btn btn-link" wire:click="generateBadge({{ $person->pendingVisit->id }})" title="Imprimir Etiqueta">
                            <i class="fa fa-print"></i>
                        </span>
                    @endif
                    <a href="#" class="btn btn-link" title="Detalhar"><i class="fa fa-search"></i></a>
                    <a href="#" class="btn btn-link" title="Alterar"><i class="fa fa-pencil"></i></a>
                    @if(!$person->hasPendingVisitors())
                        @can('visitors:store')
                            <a href="{{ route('visitors.create',['person_id'=>$person->id]) }}" class="btn btn-link" title="Registrar Entrada">
                                <i class="fa fa-check"></i>
                            </a>
                        @endCan
                    @else
                        @can('visitors:checkout')
                            <span class="btn btn-link" wire:click="prepareForCheckout({{$person->pendingVisit->id}})" title="Registrar Saida">
                                <i class="fa fa-arrow-up-right-from-square"></i>
                            </span>
                        @endCan
                    @endIf
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
