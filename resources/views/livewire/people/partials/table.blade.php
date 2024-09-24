<div>
    <div class="row">
        @if ($showCard)
            @if(isset($peopleWithReservation))
                @foreach($peopleWithReservation as $person)

                    {{--                    @if(!is_null($reservation->sector))--}}
                    <div class="col-md-6 col-lg-4 col-xxl-3 mb-2">
                        <div class="card people-min-height bg-white">
                            <div class="card-header bg-success text-white">
                                <div class="row d-flex align-items-center pe-0">
                                    <div class="col-9 fw-bolder d-inline-block d-inline-block text-truncate">
                                        <div data-label="Visitante">
                                            {{$person->full_name}}
                                        </div>
                                    </div>
                                    <div class="col-3 d-flex justify-content-end">
                                        @if ($person->reservations()->count() > 1)
                                            @can(make_ability_name_with_current_building('visitors:checkout'))
                                                <span class="btn px-0 py-0 btn-visit-action"
                                                      wire:click="openReservationModal({{$person->id}})"
                                                      title="Selecionar Visita">
                                                    <i class="fa fa-lg fa-list"></i>
                                                </span>
                                            @endcan
                                        @else
                                            @if ($person->hasPendingVisitors())
                                                @can(make_ability_name_with_current_building('visitors:checkout'))
                                                    <span class="btn btn-success px-0 py-0 btn-visit-action"
                                                          wire:click="prepareForCheckout({{ $person->pendingVisit->id }})"
                                                          title="Registrar Saída">
                                                        <i class="fa fa-lg fa-arrow-up-right-from-square"></i>
                                                    </span>
                                                @endcan
                                            @endif
                                        @endif
                                    </div>

                                </div>
                            </div>
                            <div class="card-body py-0 ps-0">
                                <div class="row">
                                    <div class="col-5 d-flex pe-0" data-label="Foto">
                                        <div class="photo-bg align-items-stretch">
                                            <img class="w-100 photo-card" src="{{ $person->photoTable }}">
                                        </div>
                                    </div>
                                    <div class="col-7 d-flex flex-column pt-2 visitor-data">
                                        {{--                                            {{dd(\Carbon\Carbon::today()->toDateString())}}--}}
                                        {{--                                            {{dd($person->reservationsByDate()->toSql())}}--}}
                                        <div class="row">
                                            @foreach($person->reservationsAsResponsible as $reservation)
                                                <div class="col-3">
                                                    <span
                                                        class="badge bg-warning text-black mb-2"> {{$reservation->code}}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="row">
                                            <div data-label="Documento" class="card-document-list">

                                                {{--                                                    {{dd($person)}}--}}
                                                @foreach ($person->documents as $document)
                                                    <div class="row bg-line-details mb-1">
                                                        <div class="col-10">
                                                            <span>{{ $document->documentType->name }}</span>:<span
                                                                class="fw-bold ms-2">{{ $document->numberMaskered }}</span>
                                                        </div>
                                                        <div class="col-2">
                                                            @if (!$person->hasPendingVisitors())
                                                                @can(make_ability_name_with_current_building('visitors:store'))
                                                                    <a href="{{ route('visitors.create', ['document_id' => $document->id]) }}"
                                                                       class="btn btn-link px-0 py-0"
                                                                       title="Registrar Entrada">
                                                                        <i class="fa fa-lg fa-check"></i>
                                                                    </a>
                                                                @endCan
                                                            @endIf
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="row card-buttons mt-auto d-flex">
                                            <div class="d-flex justify-content-center">
                                                @if ($person->hasPendingVisitors())
                                                    <div class="col-3 d-flex justify-content-end">
                                                    <span class="btn btn-link px-2 py-1"
                                                          wire:click="generateBadge({{ $person->pendingVisit->id }})"
                                                          title="Imprimir Etiqueta">
                                                        <i class="fa fa-lg fa-print"></i>
                                                    </span>
                                                    </div>
                                                @endif
                                                @can('people:show')
                                                    <div class="col-3 d-flex justify-content-end">
                                                        <a href="{{ route('people.form', ['id' => $person->id, 'redirect' => $redirect, 'disabled' => true]) }}"
                                                           class="btn btn-link px-2 py-1" title="Detalhar">
                                                            <i class="fa fa-lg fa-search"></i>
                                                        </a>
                                                    </div>
                                                @endCan
                                                @can('people:update')
                                                    <div class="col-3 d-flex justify-content-end">
                                                        <a href="{{ route('people.form', ['id' => $person->id, 'redirect' => $redirect, 'disabled' => false]) }}"
                                                           class="btn btn-link px-2 py-1" title="Alterar">
                                                            <i class="fa fa-lg fa-pencil"></i>
                                                        </a>
                                                    </div>
                                                @endCan
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    {{--                        @endif--}}
                @endforeach



                @foreach($reservationGroup as $reservation)
                    @foreach($reservation->guestsConfirmed as $guest)
                        <div class="col-md-6 col-lg-4 col-xxl-3 mb-2">
                            <div class="card people-min-height bg-white">
                                <div class="card-header bg-success text-white">
                                    <div class="row d-flex align-items-center pe-0">
                                        <div class="col-9 fw-bolder d-inline-block d-inline-block text-truncate">
                                            <div data-label="Visitante">
                                                {{ $guest->name   }}
                                            </div>
                                        </div>
                                        <div class="col-3 d-flex justify-content-end">
                                            @if ($guest->hasPendingVisitors())
                                                @can(make_ability_name_with_current_building('visitors:checkout'))
                                                    <span class="btn btn-success px-0 py-0 btn-visit-action"
                                                          wire:click="prepareForCheckout({{ $guest->pendingVisit->id }})"
                                                          title="Registrar Saída">
                                                <i class="fa fa-lg fa-arrow-up-right-from-square"></i>
                                            </span>
                                                @endCan
                                            @endIf
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body py-0 ps-0">
                                    <div class="row">
                                        <div class="col-5 d-flex pe-0" data-label="Foto">
                                            <div class="photo-bg align-items-stretch">
                                                <img class="w-100 photo-card" src="{{ $guest->photoTable }}">
                                            </div>
                                        </div>
                                        <div class="col-7 d-flex flex-column pt-2 visitor-data">


                                            <div class="row">
                                                <div class="col-12">
                                                    <span
                                                        class="badge bg-warning text-black mb-2">AGENDAMENTO: {{$reservation->code}}</span>
                                                </div>
                                                <div class="col-12">
                                                    <span
                                                        class="badge bg-warning text-black mb-2">Setor: {{$reservation->sector->name}}</span>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div data-label="Documento" class="card-document-list">
                                                    @foreach ($guest->documents as $document)
                                                        <div class="row bg-line-details mb-1">
                                                            <div class="col-10">
                                                                <span>{{ $document->documentType->name }}</span>:<span
                                                                    class="fw-bold ms-2">{{ $document->numberMaskered }}</span>
                                                            </div>
                                                            <div class="col-2">
                                                                @if (!$guest->hasPendingVisitors())
                                                                    @can(make_ability_name_with_current_building('visitors:store'))
                                                                        <a href="{{ route('visitors.create', ['document_id' => $document->id,'reservation_id'=>$reservation->id]) }}"
                                                                           class="btn btn-link px-0 py-0"
                                                                           title="Registrar Entrada">
                                                                            <i class="fa fa-lg fa-check"></i>
                                                                        </a>
                                                                    @endCan
                                                                @endIf
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="row card-buttons mt-auto d-flex">
                                                <div class="d-flex justify-content-center">
                                                    @if ($guest->hasPendingVisitors())
                                                        <div class="col-3 d-flex justify-content-end">
                                                    <span class="btn btn-link px-2 py-1"
                                                          wire:click="generateBadge({{ $guest->pendingVisit->id }})"
                                                          title="Imprimir Etiqueta">
                                                        <i class="fa fa-lg fa-print"></i>
                                                    </span>
                                                        </div>
                                                    @endif
                                                    @can('people:show')
                                                        <div class="col-3 d-flex justify-content-end">
                                                            <a href="{{ route('people.form', ['id' => $guest->id, 'redirect' => $redirect, 'disabled' => true]) }}"
                                                               class="btn btn-link px-2 py-1" title="Detalhar">
                                                                <i class="fa fa-lg fa-search"></i>
                                                            </a>
                                                        </div>
                                                    @endCan
                                                    @can('people:update')
                                                        <div class="col-3 d-flex justify-content-end">
                                                            <a href="{{ route('people.form', ['id' => $guest->id, 'redirect' => $redirect, 'disabled' => false]) }}"
                                                               class="btn btn-link px-2 py-1" title="Alterar">
                                                                <i class="fa fa-lg fa-pencil"></i>
                                                            </a>
                                                        </div>
                                                    @endCan
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endforeach
                @endforeach
            @endif
            @forelse ($people as $person)
                <!----- Visão de Cards ------>
                <div class="col-md-6 col-lg-4 col-xxl-3 mb-2">
                    <div class="card people-min-height bg-white">
                        <div class="card-header bg-blue-light text-white">
                            <div class="row d-flex align-items-center pe-0">
                                <div class="col-9 fw-bolder d-inline-block d-inline-block text-truncate">
                                    <div data-label="Visitante">
                                        {{ $person->name }}
                                    </div>
                                </div>
                                <div class="col-3 d-flex justify-content-end">
                                    @if ($person->hasPendingVisitors())
                                        @can(make_ability_name_with_current_building('visitors:checkout'))
                                            <span class="btn btn-primary px-0 py-0 btn-visit-action"
                                                  wire:click="prepareForCheckout({{ $person->pendingVisit->id }})"
                                                  title="Registrar Saída">
                                                <i class="fa fa-lg fa-arrow-up-right-from-square"></i>
                                            </span>
                                        @endCan
                                    @endIf
                                </div>
                            </div>
                        </div>
                        <div class="card-body py-0 ps-0">
                            <div class="row">
                                <div class="col-5 d-flex pe-0" data-label="Foto">
                                    <div class="photo-bg align-items-stretch">
                                        <img class="w-100 photo-card" src="{{ $person->photoTable }}">
                                    </div>
                                </div>
                                <div class="col-7 d-flex flex-column pt-2 visitor-data">

                                    @if ($person->hasPendingVisitors())
                                        <div class="row">
                                            <div class="col-12">
                                                <span class="badge bg-warning text-black mb-2">VISITA EM ABERTO</span>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="row">
                                        <div data-label="Documento" class="card-document-list">
                                            @foreach ($person->documents as $document)
                                                <div class="row bg-line-details mb-1">
                                                    <div class="col-10"><span>{{ $document->documentType->name }}</span>:<span
                                                            class="fw-bold ms-2">{{ $document->numberMaskered }}</span>
                                                    </div>
                                                    <div class="col-2">
                                                        @if (!$person->hasPendingVisitors())
                                                            @can(make_ability_name_with_current_building('visitors:store'))
                                                                <a href="{{ route('visitors.create', ['document_id' => $document->id]) }}"
                                                                   class="btn btn-link px-0 py-0"
                                                                   title="Registrar Entrada">
                                                                    <i class="fa fa-lg fa-check"></i>
                                                                </a>
                                                            @endCan
                                                        @endIf
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="row card-buttons mt-auto d-flex">
                                        <div class="d-flex justify-content-center">
                                            @if ($person->hasPendingVisitors())
                                                <div class="col-3 d-flex justify-content-end">
                                                    <span class="btn btn-link px-2 py-1"
                                                          wire:click="generateBadge({{ $person->pendingVisit->id }})"
                                                          title="Imprimir Etiqueta">
                                                        <i class="fa fa-lg fa-print"></i>
                                                    </span>
                                                </div>
                                            @endif
                                            @can('people:show')
                                                <div class="col-3 d-flex justify-content-end">
                                                    <a href="{{ route('people.form', ['id' => $person->id, 'redirect' => $redirect, 'disabled' => true]) }}"
                                                       class="btn btn-link px-2 py-1" title="Detalhar">
                                                        <i class="fa fa-lg fa-search"></i>
                                                    </a>
                                                </div>
                                            @endCan
                                            @can('people:update')
                                                <div class="col-3 d-flex justify-content-end">
                                                    <a href="{{ route('people.form', ['id' => $person->id, 'redirect' => $redirect, 'disabled' => false]) }}"
                                                       class="btn btn-link px-2 py-1" title="Alterar">
                                                        <i class="fa fa-lg fa-pencil"></i>
                                                    </a>
                                                </div>
                                            @endCan
                                        </div>
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
                @if (!empty($people) && $people->total() > 0)
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
                                                    <div
                                                        class="col-5 col-lg-6 text-center text-lg-start fw-bolder ps-3">
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
                        <div class="card">
                            <div class="card-body py-lg-1">
                                <div class="row d-flex align-items-center">
                                    <div class="col-12 col-lg-10">
                                        <div class="row d-flex align-items-center">
                                            <div class="col-4 col-lg-1 text-center text-lg-start">
                                                <img class="w-75" src="{{ $person->photoTable }}">
                                            </div>
                                            <div class="col-8 col-lg-11">
                                                <div class="row">
                                                    <div class="col-5 col-lg-6 text-center text-lg-start">
                                                        <span class="fw-bold">{{ $person->name }}</span>
                                                        @if ($person->hasPendingVisitors())
                                                            <span
                                                                class="badge bg-warning text-black">VISITA EM ABERTO</span>
                                                        @endif
                                                    </div>
                                                    <div class="col-3 col-lg-6 text-center text-lg-start">
                                                        @foreach ($person->documents as $document)
                                                            <span>{{ $document->documentType->name }}</span>: <span
                                                                class="fw-bold">{{ $document->numberMaskered }}</span>
                                                            @if (!$person->hasPendingVisitors())
                                                                @can(make_ability_name_with_current_building('visitors:store'))
                                                                    <a href="{{ route('visitors.create', ['document_id' => $document->id]) }}"
                                                                       class="btn btn-link" title="Registrar Entrada">
                                                                        <i class="fa fa-lg fa-check"></i>
                                                                    </a>
                                                                @endCan
                                                            @endIf
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-2 text-center text-lg-end actions">
                                        @if ($person->hasPendingVisitors())
                                            <span class="btn btn-link"
                                                  wire:click="generateBadge({{ $person->pendingVisit->id }})"
                                                  title="Imprimir Etiqueta">
                                                <i class="fa fa-lg fa-print"></i>
                                            </span>
                                        @endif
                                        @can('people:show')
                                            <a href="{{ route('people.form', ['id' => $person->id, 'redirect' => $redirect, 'disabled' => true]) }}"
                                               class="btn btn-link" title="Detalhar"><i class="fa fa-lg fa-search"></i></a>
                                        @endCan
                                        @can('people:update')
                                            <a href="{{ route('people.form', ['id' => $person->id, 'redirect' => $redirect, 'disabled' => false]) }}"
                                               class="btn btn-link" title="Alterar" id="editPerson"><i
                                                    class="fa fa-lg fa-pencil"></i></a>
                                        @endCan
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-warning mt-2">
                            <i class="fa fa-lg fa-exclamation-triangle"></i> Nenhuma Pessoa encontrada.
                        </div>
                    </div>
                @endforelse
            </div>
        @endif
    </div>
    <div class="d-flex justify-content-center mt-4">
        {{ $people->links() }}
    </div>

</div>
