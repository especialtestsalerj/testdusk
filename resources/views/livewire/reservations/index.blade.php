<div class="py-4 px-4 conteudo">

    <div class="row mb-4 d-flex align-items-center">

        <div class="col-8 col-md-8 d-flex align-items-center">
            <h3><i class="fa-solid fa-calendar-days"></i> Agenda do(s) Setor(es): Informática</h3>
        </div>


        <div class="col-4 col-md-4 align-self-center d-flex justify-content-end gap-4">
            <a id="novo" href="{{route('reservation.form-from-user')}}" class="btn btn-primary text-white float-right"
               title="Nova Reserva">
                <i class="fa fa-plus"></i> Nova
            </a>
        </div>
    </div>

    <div>
        <div class="row">
            @foreach($reservations as $reservation)

                <div class="cards-striped mx-lg-0 mt-lg-2 my-2">
                    <div class="card">
                        <div class="card-body py-lg-1">
                            <div class="row d-flex align-items-center">
                                <div class="col-12 col-lg-9">
                                    <div class="row d-flex align-items-center">
                                        <div class="col-4 col-lg-3 text-center text-lg-start">
                                            <span class="fw-bold">Visitante:</span> {{json_decode($reservation['person'])->full_name}}
                                        </div>
                                        <div class="col-5 col-lg-3 text-center text-lg-start">
                                            <span class="fw-bold">Celular:</span> {{json_decode($reservation['person'])->mobile}}
                                        </div>
                                        <div class="col-3 col-lg-4 text-center text-lg-start">
                                            <span class="fw-bold">E-mail:</span> {{json_decode($reservation['person'])->email}}

                                        </div>
                                    </div>
                                    <div class="row d-flex align-items-center">

                                        <div class="col-1 col-lg-2 text-center text-lg-start">
                                            <span class="fw-bold">Data:</span> {{date_format($reservation->reservation_date,"d/m/Y")}}
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

                                            <span class="fw-bold"> Setor:</span> {{$reservation->sector->name}}
                                        </div>

                                    </div>
                                </div>
                                <div class="col-12 col-lg-3 text-center text-lg-end">
                                    <a href="http://localhost:10006/routines/93/show?redirect=routines.index" class="btn btn-link btn-sm mx-2" dusk="manageRoutine-93" title="Gerenciar Rotina">

                                    </a>
                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#finishModal93" title="Finalizar Rotina" dusk="finishRoutine"
                                        wire:click="prepareForChangeDate({{$reservation}})">
                                        <i class="fa-solid fa-calendar-days"></i> Reagendar
                                    </button>
                                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#finishModal93" title="Finalizar Rotina" dusk="finishRoutine"
                                    wire:click="prepareForConfirmReservation({{$reservation}})">
                                        <i class="fa-solid fa-circle-check"></i> Confirmar
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#finishModal93" title="Finalizar Rotina" dusk="finishRoutine"
                                            wire:click="prepareForCancelReservation({{$reservation}})">
                                        <i class="fa-solid fa-ban"></i> Cancelar
                                    </button>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>

            @endforeach
        </div>
    </div>

</div>
