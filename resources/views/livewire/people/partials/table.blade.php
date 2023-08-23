<div>
    <div class="row">
        @if ($showCard)
            @forelse ($people as $person)

                <!----- Visão de Cards ------>
                <div class="col-md-6 col-lg-4 col-xxl-3 mb-2">
                    <div class="card people-min-height bg-white">
                        <div class="card-header py-1">
                            <div class="row d-flex align-items-center">
                                <div class="col-10 fw-bolder d-inline-block d-inline-block text-truncate">
                                    <div data-label="Visitante">
                                        {{ $person->name }}
                                    </div>
                                </div>
                                <div class="col-2 d-flex justify-content-end">
                                    @if ($person->hasPendingVisitors())
                                        @can('visitors:checkout')
                                            <span class="btn btn-link px-0 py-0"
                                                wire:click="prepareForCheckout({{ $person->pendingVisit->id }})"
                                                title="Registrar Saida">
                                                <i class="fa fa-lg fa-arrow-up-right-from-square"></i>
                                            </span>
                                        @endCan
                                    @else
                                        @can('visitors:store')
                                            <a href="{{ route('visitors.create', ['person_id' => $person->id]) }}"
                                               class="btn btn-link px-0 py-0" title="Registrar Entrada">
                                                <i class="fa fa-lg fa-check"></i>
                                            </a>
                                        @endCan
                                    @endIf
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-3" data-label="Foto">
                                    <img class="w-100" src="{{ $person->photo }}">
                                </div>
                                <div class="col-8 d-flex align-items-center">
                                    <div class="row">
                                        <div class="col-12">
                                            @if ($person->hasPendingVisitors())
                                                <span class="badge bg-warning text-black mb-2">VISITA EM ABERTO</span>
                                            @endif

                                            <div data-label="Documento">
                                                @foreach ($person->documents as $document)
                                                    <span class="fw-bold">{{ $document->documentType->name }}</span>:
                                                    {{ $document->numberMaskered }}<br>
                                                    @if ($document->state?->initial)
                                                        - {{ $document->state->initial }}
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-1 actions px-0">
                                    <div class="row">
                                        @if ($person->hasPendingVisitors())
                                            <div class="col-12">
                                                <span class="btn btn-link px-0 pt-0 pb-1"
                                                    wire:click="generateBadge({{ $person->pendingVisit->id }})"
                                                    title="Imprimir Etiqueta">
                                                    <i class="fa fa-lg fa-print"></i>
                                                </span>
                                            </div>
                                        @endif
                                        @can('people:show')
                                            <div class="col-12">
                                                <a href="{{route('people.form', ['id' => $person->id, 'redirect' => $redirect, 'disabled' => true])}}" class="btn btn-link px-0 pt-0 pb-1" title="Detalhar"><i
                                                        class="fa fa-lg fa-search"></i></a>
                                            </div>
                                        @endCan
                                        @can('people:update')
                                            <div class="col-12">
                                                <a href="{{route('people.form', ['id' => $person->id, 'redirect' => $redirect, 'disabled' => false])}}" class="btn btn-link px-0 pt-0 pb-1" title="Alterar"><i
                                                        class="fa fa-lg fa-pencil"></i></a>
                                            </div>
                                        @endCan
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!----- FIM da Visão de Cards ------>
                @empty
                    <div class="col-12">
                        <div class="alert alert-warning mt-2">
                            <i class="fa fa-lg fa-exclamation-triangle"></i> Nenhuma Pessoa encontrada.
                        </div>
                    </div>
            @endforelse
        @else

            <div class="col-md-12">
                @if(!empty($people) && $people->total()>0)
                    <div class="mx-lg-0 my-1">
                        <div class="">
                            <div class="py-lg-1">
                                <div class="row d-flex align-items-center">
                                    <div class="col-12 col-lg-10">
                                        <div class="row d-flex align-items-center ps-2">
                                            <div class="col-4 col-lg-1 text-center fw-bolder">
                                                Foto
                                            </div>
                                            <div class="col-8 col-lg-11">
                                                <div class="row">
                                                    <div class="col-5 col-lg-6 text-center text-lg-start fw-bolder ps-3">
                                                        Nome
                                                    </div>
                                                    <div class="col-3 col-lg-6 text-center text-lg-start fw-bolder">
                                                        Documento(s)
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                @forelse ($people as $person)

                    <!----- Visão de Card em Linhas ------>
                    <div class="cards-striped mx-lg-0 mt-lg-1 my-1">
                        <div class="card cursor-pointer">
                            <div class="card-body py-lg-1">
                                <div class="row d-flex align-items-center">
                                    <div class="col-12 col-lg-10">
                                        <div class="row d-flex align-items-center">
                                            <div class="col-4 col-lg-1 text-center text-lg-start">
                                                <img class="w-75" src="{{ $person->photo }}">
                                            </div>
                                            <div class="col-8 col-lg-11">
                                                <div class="row">
                                                    <div class="col-5 col-lg-6 text-center text-lg-start">
                                                        <span class="fw-bold">{{ $person->name }}</span>
                                                        @if ($person->hasPendingVisitors())
                                                            <span class="badge bg-warning text-black">VISITA EM ABERTO</span>
                                                        @endif
                                                    </div>
                                                    <div class="col-3 col-lg-6 text-center text-lg-start">
                                                        @foreach ($person->documents as $document)
                                                            <span class="fw-bold">{{ $document->documentType->name }}</span>:
                                                            {{ $document->numberMaskered }}
                                                            @if ($document->state?->initial)
                                                                - {{ $document->state->initial }}
                                                            @endif
                                                            &nbsp;
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-2 text-center text-lg-end actions">
                                        @if ($person->hasPendingVisitors())
                                            <span class="btn btn-link" wire:click="generateBadge({{ $person->pendingVisit->id }})" title="Imprimir Etiqueta">
                                                <i class="fa fa-lg fa-print"></i>
                                            </span>
                                        @endif
                                            @can('people:show')
                                                <a href="{{route('people.form', ['id' => $person->id, 'redirect' => $redirect, 'disabled' => true])}}" class="btn btn-link" title="Detalhar"><i class="fa fa-lg fa-search"></i></a>
                                            @endCan
                                            @can('people:update')
                                                <a href="{{route('people.form', ['id' => $person->id, 'redirect' => $redirect, 'disabled' => false])}}" class="btn btn-link" title="Alterar" id="editPerson"><i class="fa fa-lg fa-pencil"></i></a>
                                            @endCan
                                        @if (!$person->hasPendingVisitors())
                                            @can('visitors:store')
                                                <a href="{{ route('visitors.create', ['person_id' => $person->id]) }}"
                                                   class="btn btn-link" title="Registrar Entrada">
                                                    <i class="fa fa-lg fa-check"></i>
                                                </a>
                                            @endCan
                                        @else
                                                {{--
                                                @can('visitors:checkout')
                                                <span class="btn btn-link" wire:click="prepareForCheckout({{ $person->pendingVisit->id }})" title="Registrar Saida">
                                                    <i class="fa fa-lg fa-arrow-up-right-from-square"></i>
                                                </span>
                                                @endCan
                                                --}}
                                        @endIf
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!----- FIM da Visão de Card em Linhas ------>




                    <!-----Visão de Tabela Antiga------>
           {{--


                    <tr class="align-middle">
                        <td data-label="Foto">
                            <img class="w-75" src="{{ $person->photo }}">
                        </td>
                        <td data-label="Nome">
                            {{ $person->name }}
                            @if ($person->hasPendingVisitors())
                                <span class="badge bg-warning text-black">Visita em aberto</span>
                            @endif
                        </td>
                        <td data-label="Documento(s)">
                            @foreach ($person->documents as $document)
                                <span class="fw-bold">{{ $document->documentType->name }}</span>:
                                {{ $document->numberMaskered }}
                                @if ($document->state?->initial)
                                    - {{ $document->state->initial }}
                                @endif
                                &nbsp;
                            @endforeach
                        </td>
                        <td class="actions">
                            @if ($person->hasPendingVisitors())
                                <span class="btn btn-link" wire:click="generateBadge({{ $person->pendingVisit->id }})"
                                    title="Imprimir Etiqueta">
                                    <i class="fa fa-lg fa-print"></i>
                                </span>
                            @endif
                                @can('people:show')
                                    <a href="{{route('people.form', ['id' => $person->id, 'redirect' => $redirect, 'disabled' => true])}}" class="btn btn-link" title="Detalhar"><i class="fa fa-lg fa-search"></i></a>
                                @endCan
                                @can('people:update')
                                    <a href="{{route('people.form', ['id' => $person->id, 'redirect' => $redirect, 'disabled' => false])}}" class="btn btn-link" title="Alterar" id="editPerson"><i class="fa fa-lg fa-pencil"></i></a>
                                @endCan
                            @if (!$person->hasPendingVisitors())
                                @can('visitors:store')
                                    <a href="{{ route('visitors.create', ['person_id' => $person->id]) }}"
                                        class="btn btn-link" title="Registrar Entrada">
                                        <i class="fa fa-lg fa-check"></i>
                                    </a>
                                @endCan
                            @else
                                @can('visitors:checkout')
                                    <span class="btn btn-link"
                                        wire:click="prepareForCheckout({{ $person->pendingVisit->id }})"
                                        title="Registrar Saida">
                                        <i class="fa fa-lg fa-arrow-up-right-from-square"></i>
                                    </span>
                                @endCan
                            @endIf
                        </td>
                    </tr>
                    --}}
                    <!-----Fim da Visão de Tabela Antiga------>
                @empty
                    <div class="col-12">
                        <div class="alert alert-warning mt-2">
                            <i class="fa fa-lg fa-exclamation-triangle"></i> Nenhuma Pessoa encontrada.
                        </div>
                    </div>
                @endforelse
                @if (!empty($people))
                    <!--</tbody>
                    </table>-->
                @endif

            </div>
        @endif
    </div>
    <div class="d-flex justify-content-center mt-4">
        {{ $people->links() }}
    </div>
</div>
