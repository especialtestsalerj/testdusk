<div class="row">
    <div class="col-md-12">

        @forelse ($people as $person)
            <div class="cards-striped mx-lg-0 mt-lg-2 my-2">
                <div class="card">
                    <div class="card-body py-1">
                        <div class="row d-flex align-items-center">
                            <div class="col-12 col-lg-4 text-center text-lg-start">
                                <span class="fw-bold">Nome/Nome Social:</span> {{ $person->name}}
                                @if($person->hasPendingVisitors())
                                    <span class="badge bg-warning text-black">Visita em aberto </span>
                                @endif
                            </div>

                            <div class="col-12 col-lg-4 text-center text-lg-start">
                                <span class="fw-bold">Documento(s):</span>
                                <br/>
                                @foreach($person->documents as $document)
                                    <span class="fw-bold">{{$document->documentType->name}}</span> : {{$document->number}}
                                    @if($document->state?->initial)
                                        - {{$document->state->initial}}
                                    @endif
                                    <br />
                                @endforeach
                            </div>
                            <div class="col-12 col-lg-4 text-center text-lg-start">
                                @can('people:show')
                                    <i class="fa fa-search"></i>
                                @endCan
                                @can('people:update')
                                    <i class="fa-solid fa-pen"></i>
                                @endCan

                                @if(!$person->pendingVisit)
                                    @can('visitors:store')
                                    <a href="{{ route('visitors.create',['person_id'=>$person->id]) }}" class="btn btn-link">
                                        <i class="fa-solid fa-user-plus"></i>
                                    </a>
                                    @endCan
                                @else
                                    @can('visitors:checkout')
                                        <span class="btn btn-link" wire:click="prepareForCheckout({{$person->pendingVisit->id}})">
                                            <i class="fa-solid fa-user-minus"></i>
                                        </span>
                                    @endCan
                                @endIf
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        @empty
            <div class="alert alert-warning mt-2">
                <i class="fa fa-exclamation-triangle"></i> Nenhum/a Pessoa encontrado/a.
            </div>
        @endforelse
        <div class="d-flex justify-content-center mt-2">
            {{ $people->links() }}
        </div>
    </div>
</div>
