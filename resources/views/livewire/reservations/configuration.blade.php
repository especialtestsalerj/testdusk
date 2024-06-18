<div>

    @include('layouts.msg')
    @php
        use Carbon\Carbon;
    @endphp

    <form>

        @csrf
        <div class="row mt-3">
            <div class="form-group col-3">
                <h4 for="sector_id" style="margin-left: 10px;" class="form-label">Setor:</h4>
                <div wire:ignore>
                    <select class="select2 form-control text-uppercase"
                            name="sector_id" id="sector_id"
                            wire:model="sector_id" x-ref="sector_id" wire:change="loadCapacities" >

                        <option value="">SELECIONE</option>
                        @foreach ($sectors as $sector)
                            <option value="{{ $sector->id ?? $sector['id']}}">
                                {{ convert_case($sector->nickname ?? $sector['nickname'], MB_CASE_UPPER) }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        @if(!empty($this->sector_id))
            <div class="row mt-3">
                <div class="col-md-4 mb-2">
                    <div class="row my-2">
                        <div class="col-sm-8 align-self-center">
                            <h3 class="mb-0"><i class="fa-solid fa-clock"></i>
                                Horários: {{$capacities->count()}}
                            </h3>
                        </div>
                        <div class="col-sm-4 align-self-center d-flex justify-content-end">
                            <span class="btn btn-sm btn-primary text-white" wire:click="createCapacity({{$this->sector_id}})"
                                  data-bs-toggle="modal" data-bs-target="#capacity-modal" title="Novo Documento">
                                <i class="fa fa-plus"></i>
                            </span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            @foreach($capacities as $capacity)

                                <div class="cards-striped mx-lg-0 mt-lg-2">
                                    <div class="card">
                                        <div class="card-body py-1">
                                            <div class="row d-flex align-items-center">
                                                <div class="col-12 col-lg-3 text-center text-lg-start">
                                                    <span class="fw-bold">Horário:</span> {{$capacity->hour}}
                                                </div>
                                                <div class="col-12 col-lg-6 text-center text-lg-start">
                                                    <span class="fw-bold">Vagas:</span> {{$capacity->maximum_capacity}}
                                                </div>
                                                <div class="col-12 col-lg-3 text-center text-lg-end">
                                                    <span class="btn btn-link" wire:click="editCapacity({{$capacity->id}})" data-bs-toggle="modal"
                                                          data-bs-target="#capacity-modal" title="Criar Horários">
                                                                    <i class="fa fa-lg fa-pencil"></i>
                                                                    </span>
                                                    <span class="btn btn-link" wire:click="prepareForDeleteCapacity({{$capacity->id}})" title="Remover Horário">
                                                                    <i class="fa fa-lg fa-trash"></i>
                                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-2">
                    <div class="row my-2">
                        <div class="col-sm-8 align-self-center">
                            <h3 class="mb-0"><i class="fa-solid fa-calendar-xmark"></i>
                                Datas Indisponíveis:
                            </h3>
                        </div>
                        <div class="col-sm-4 align-self-center d-flex justify-content-end">
                                                                        <span class="btn btn-sm btn-primary text-white" wire:click="createDocument(7907)" data-bs-toggle="modal" data-bs-target="#document-modal" title="Novo Documento">
                                                <i class="fa fa-plus"></i>
                                            </span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            @foreach($blockedDates as $blockeddate)

                                <div class="cards-striped mx-lg-0 mt-lg-2">
                                    <div class="card">
                                        <div class="card-body py-1">
                                            <div class="row d-flex align-items-center">
                                                <div class="col-12 col-lg-3 text-center text-lg-start">
                                                    <span class="fw-bold">Data:</span> {{Carbon::parse($blockeddate->date)->format('d/m/Y')}}
                                                </div>

                                                <div class="col-12 col-lg-3 text-center text-lg-end">
                                                                                                                        <span class="btn btn-link" wire:click="editDocument(7908)" data-bs-toggle="modal" data-bs-target="#document-modal" title="Alterar Documento">
                                                                    <i class="fa fa-lg fa-pencil"></i>
                                                                    </span>
                                                    <span class="btn btn-link" wire:click="prepareForDeleteDocument(7908)" title="Remover Documento">
                                                                    <i class="fa fa-lg fa-trash"></i>
                                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-2">
                    <div class="row my-2">
                        <div class="col-sm-8 align-self-center">
                            <h3 class="mb-0"><i class="fa-solid fa-star"></i>
                                Datas & Horários Especiais:
                            </h3>
                        </div>
                        <div class="col-sm-4 align-self-center d-flex justify-content-end">
                                                                        <span class="btn btn-sm btn-primary text-white" wire:click="createDocument(7907)" data-bs-toggle="modal" data-bs-target="#document-modal" title="Novo Documento">
                                                <i class="fa fa-plus"></i>
                                            </span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            @foreach($blockedDates as $blockeddate)

                                <div class="cards-striped mx-lg-0 mt-lg-2">
                                    <div class="card">
                                        <div class="card-body py-1">
                                            <div class="row d-flex align-items-center">
                                                <div class="col-12 col-lg-3 text-center text-lg-start">
                                                    <span class="fw-bold">Data:</span> {{Carbon::parse($blockeddate->date)->format('d/m/Y')}}
                                                </div>

                                                <div class="col-12 col-lg-3 text-center text-lg-end">
                                                                                                                        <span class="btn btn-link" wire:click="editDocument(7908)" data-bs-toggle="modal" data-bs-target="#document-modal" title="Alterar Documento">
                                                                    <i class="fa fa-lg fa-pencil"></i>
                                                                    </span>
                                                    <span class="btn btn-link" wire:click="prepareForDeleteDocument(7908)" title="Remover Documento">
                                                                    <i class="fa fa-lg fa-trash"></i>
                                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>


            </div>
            @endif

    </form>

    @livewire('capacities.modal')
</div>
