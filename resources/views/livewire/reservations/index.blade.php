<div class="py-4 px-4 conteudo">

    <div class="row mb-4 d-flex align-items-center">

        <div class="col-4 col-md-4 d-flex align-items-center">
            <h3 class="mb-0 me-2">
                <i class="fa fa-people-roof"></i> Agendamentos
            </h3>
            <span class="mt-1 p-2 badge bg-danger text-white">
                            ({{$countReservations}})
                    </span>
        </div>

        <div class="col-4 col-md-8 align-self-center d-flex justify-content-end gap-4">
            <span class="btn btn-sm btn-primary text-white"
                  data-bs-toggle="modal" data-bs-target="#reservation-modal" title="Novo Documento">
                                <i class="fa fa-plus"></i> Novo
            </span>
        </div>

        <div class="row align-items-center pt-3">

            <div class="col-md-4 d-flex align-items-center">
                <h3 class="me-2"><i class="fa-solid fa-calendar-days"></i> Setor: </h3>
                <div wire:ignore class="flex-grow-1">
                    <select class="select2 form-control text-uppercase" name="sector_id" id="sector_id"
                            wire:model="sector_id" x-ref="sector_id">
                        <option value="">SELECIONE</option>
                        @foreach ($sectors as $sector)
                            <option value="{{ $sector->id ?? $sector['id'] }}">
                                {{ convert_case($sector->alias ?? $sector['alias'], MB_CASE_UPPER) }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-2 d-flex align-items-center">
                <h3 class="me-2"> Status: </h3>
                <div class="flex-grow-1">
                    <select class="form-control text-uppercase" name="status_id" id="status_id" wire:model="status_id">
                        <option value="">TODAS AS VISITAS</option>
                        @foreach ($statuses as $status)
                            <option value="{{ $status->id}}">
                                {{$status->name}}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>


            <div class="col-md-6 d-flex align-items-center">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Pesquisar..."
                           wire:model.debounce.500ms="searchString" value="">
                    <span class="input-group-text">
                            <i class="fa fa-search"></i>
                        </span>
                    <span class="input-group-text" onClick="javascript:document.getElementById('searchForm').submit();">
                            <a href="{{ route('visitors.index') }}">
                                <i class="fas fa-eraser"></i>
                            </a>
                        </span>
                </div>
            </div>

            <div class="col-4 col-md-1 mt-2 mt-lg-0">
                <h3 class="me-2"> De: </h3>
                <input wire:model.debounce.200ms="startDate" type="date" max="3000-01-01"
                       title="Filtrar por Entrada" class="form-control text-uppercase"/>
            </div>
            <div class="col-4 col-md-1 mt-2 mt-lg-0">
                <h3 class="me-2"> Até: </h3>
                <input wire:model.debounce.200ms="endDate" type="date" max="3000-01-01"
                       title="Filtrar por Saída" class="form-control text-uppercase"/>
            </div>

        </div>


    </div>

    <div>
        @if($this->sector_id)
            <div class="row" wire:poll>

                @forelse ($reservations as $reservation)

                    <div class="cards-striped mx-lg-0 mt-lg-2 my-2">
                        <div class="card">
                            <div class="card-body py-lg-1">
                                <div class="row d-flex align-items-center">
                                    <div class="col-12 col-lg-9">
                                        <div class="row d-flex align-items-center">
                                            <div class="col-6 col-lg-5 text-center text-lg-start">
                                                <span class="fw-bold">Visitante:</span> {{ json_decode($reservation['person'])->full_name }}
                                                @if($reservation->quantity > 1)
                                                    <span class="badge bg-danger rounded-circle more-destinys"
                                                          data-bs-toggle="tooltip"
                                                          data-bs-placement="top"
                                                          data-bs-custom-class="custom-tooltip"
                                                          data-bs-html="true"
                                                          data-bs-title="<div class='fw-bold mt-1 pt-0 pb-0 multiple-destiny text-truncate'>teste</div>">
            +{{ $reservation->quantity - 1 }}
        </span>

                                                    <label class="badge bg-info">Grupo</label>
                                                @endif
                                            </div>
                                            <div class="col-5 col-lg-3 text-center text-lg-start">
                                                <span
                                                    class="fw-bold">Celular:</span> {{json_decode($reservation['person'])->mobile}}
                                            </div>
                                            <div class="col-3 col-lg-4 text-center text-lg-start">
                                                <span
                                                    class="fw-bold">E-mail:</span> {{json_decode($reservation['person'])->email}}

                                            </div>
                                        </div>
                                        <div class="row d-flex align-items-center">

                                            <div class="col-1 col-lg-2 text-center text-lg-start">
                                                <span
                                                    class="fw-bold">Data:</span> {{date_format($reservation->reservation_date,"d/m/Y")}}
                                            </div>
                                            <div class="col-2 col-lg-2 text-center text-lg-start">
                                                <span class="fw-bold">Horário:</span> {{$reservation->capacity->hour}}
                                            </div>
                                            <div class="col-3 col-lg-3 text-center text-lg-start">
                                                <span class="fw-bold">Status:</span> <label class="badge
                                        @if($reservation->reservation_status_id == 1)
                                            bg-dark2
                                            @elseif($reservation->reservation_status_id == 2 || $reservation->reservation_status_id == 4)
                                            bg-success
                                            @else
                                            bg-danger
                                            @endif
                                        "> {{$reservation->reservationStatus->name}} </label>
                                            </div>
                                        </div>
                                        <div class="row d-flex align-items-center">
                                            <div class="col-6 col-lg-6 text-center text-lg-start">

                                                <span class="fw-bold"> Setor:</span> {{$reservation->sector?->name}}
                                            </div>

                                        </div>
                                        <div class="row d-flex align-items-center">
                                            <div class="col-6 col-lg-6 text-center text-lg-start">

                                                <span class="fw-bold"> Motivo:</span> {{$reservation->motive}}
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-3 text-center text-lg-end">
                                        <a href="http://localhost:10006/routines/93/show?redirect=routines.index"
                                           class="btn btn-link btn-sm mx-2" dusk="manageRoutine-93"
                                           title="Gerenciar Rotina">

                                        </a>
                                        <button type="button" class="btn btn-secondary btn-sm text-white" data-bs-toggle="modal"
                                                title="Alterar Visita"
                                                @if($reservation->reservationStatus->name != 'AGUARDANDO CONFIRMAÇÃO' )
                                                    disabled="disabled"
                                                @endif
                                                dusk="finishRoutine"
                                                wire:click="editReservation({{$reservation->id}})"
                                                >
                                            <i class="fa-solid fa-calendar-days"></i> Alterar
                                        </button>

                                        <button type="button" class="btn btn-success btn-sm text-white" data-bs-toggle="modal"
                                                title="Confirmar reserva"
                                                @if($reservation->reservationStatus->name != 'AGUARDANDO CONFIRMAÇÃO')
                                                    disabled="disabled"
                                                @endif
                                                dusk="finishRoutine"
                                                wire:click="prepareForConfirmReservation({{$reservation->id}})">
                                            <i class="fa-solid fa-circle-check"></i> Confirmar
                                        </button>

                                        <button type="button" class="btn btn-danger btn-sm text-white" data-bs-toggle="modal"
                                                title="Cancelar Rotina"
                                                @if(!($reservation->reservationStatus->name == 'AGUARDANDO CONFIRMAÇÃO' ||
                                                    $reservation->reservationStatus->name == 'VISITA AGENDADA'))
                                                    disabled="disabled"
                                                @endif
                                                dusk="finishRoutine"
                                                wire:click="prepareForCancelReservation({{$reservation->id}})">
                                            <i class="fa-solid fa-ban"></i> Cancelar
                                        </button>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                @empty
                    <div class="cards-striped mx-lg-0 mt-lg-2 my-2">
                        <div class="card">
                            <div class="card-body py-lg-1">
                                <div class="row d-flex align-items-center">
                                    <div class="col-12 col-lg-9">
                                        <div class="row d-flex align-items-center">
                                            Não há Visitas agendadas para o período.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforelse
                    <div class="d-flex justify-content-center mt-4">{{ $reservations->links() }}
                    </div>
                @endif

            @livewire('reservations.modal')
    </div>
    </div>
</div>
