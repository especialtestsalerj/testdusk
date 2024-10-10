<div>
    <div class="py-4 px-4 conteudo">
        <div class="">
            <div class="row mb-4 d-flex align-items-center">
                <div class="col-6 col-sm-5 col-md-6 d-flex align-items-center">
                    <h3 class="mb-0 me-2"><i class="fa fa-users"></i> Agendamentos </h3>
                    <span class="mt-1 p-2 badge bg-danger text-white">
                            ({{$countResults}})
                    </span>
                </div>
            </div>

            @if (url()->previous() == route('visitors.index'))
                <div class="row mb-4">
                    <div class="col-12 d-flex justify-content-center">
                        <span class="badge bg-info text-black required-msg"><i class="fa fa-circle-info"></i> Pesquisar pessoa pelo nome e verificar documentos desejados.</span>
                    </div>
                </div>
            @endif

            <div class="row mb-4 d-flex align-items-center">
                <div class="col-12 col-lg-11">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Pesquisar..."
                               wire:model.debounce.200ms="searchString" value="">
                        <span class="input-group-text">
                            <i class="fa fa-search"></i>
                        </span>
                        <span class="input-group-text"
                              onClick="javascript:document.getElementById('searchForm').submit();">
                            <a href="{{ route('people.index') }}">
                                <i class="fas fa-eraser"></i>
                            </a>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="p-0">
            <div class="row">
            @foreach($reservations as $reservation)

                <div class="col-md-6 col-lg-4 col-xxl-3 mb-2">
                    <div class="card people-min-height bg-white">
                        <div class="card-header bg-success text-white">
                            <div class="row d-flex align-items-center pe-0">
                                <div class="col-9 fw-bolder d-inline-block d-inline-block text-truncate">
                                    <div data-label="Visitante">
                                        {{$reservation->code}}
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="card-body py-0 ps-0">
                            <div class="row">
                                <div class="col-5 d-flex pe-0" data-label="Foto">
                                    <div class="photo-bg align-items-stretch">
                                        <img class="w-100 photo-card" src="{{ $reservation->responsible->photoTable }}">
                                    </div>
                                </div>
                                <div class="col-7 d-flex flex-column pt-2 visitor-data">

                                    <div class="row">
                                        <div class="row bg-line-details mb-1">
                                            <div class="col-12">
                                                <span>Visitante</span>:<span
                                                    class="fw-bold ms-2">{{ $reservation->responsible->full_name }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div data-label="Documento" class="card-document-list">
                                            @foreach ($reservation->responsible->documents as $document)
                                                <div class="row bg-line-details mb-1">
                                                    <div class="col-12">
                                                        <span>{{ $document->documentType->name }}</span>:<span
                                                            class="fw-bold ms-2">{{ $document->numberMaskered }}</span>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="row bg-line-details mb-1">
                                            <div class="col-12">
                                                <span>Setor</span>:<span
                                                    class="fw-bold ms-2">{{ $reservation->sector?->nickname }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="row bg-line-details mb-1">
                                            <div class="col-12">
                                                <span>Data e Hora:</span>:<span
                                                    class="fw-bold ms-2">{{date_format($reservation->reservation_date,"d/m/Y")}} às  {{$reservation->capacity->hour}}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="row bg-line-details mb-1">
                                            <div class="col-12">
                                                <span>Status</span>:<span
                                                    class="fw-bold ms-2">{{ $reservation->reservationStatus->name }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach
            </div>


            <div class="d-flex justify-content-center mt-4">
                {{ $reservations->links() }}
            </div>

        </div>
    </div>
</div>
