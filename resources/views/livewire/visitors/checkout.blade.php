<div>
<div wire:poll.keep-alive x-data="" class="py-4 px-4">

    <div class="row border-bottom border-dark mb-4 pb-2">
        <div class="col-md-8">
            <h3 class="mb-0">Visitas - Checkout de Visitante</h3>
        </div>
    </div>

    <div  class="row g-5">



        <div
            wire:ignore class="col-md-3">
            <div  class="position-sticky" style="top: 2rem;">
                <div x-on:qrcodescanned="$wire.scan($event.detail)" id="reader" width="600px"></div>
            </div>
        </div>

        <div class="col-md-9">

            <div class="row mb-3">
                <div class="col-4">
                    <input wire:model.debounce.500ms="searchName" class="form-control" type="text" placeholder="Filtrar por nome" aria-label="default input example">
                </div>
                <div class="col-3">
                    <input wire:model.debounce.200ms="startDate" type="datetime-local" max="3000-01-01T23:59" class="form-control text-uppercase" />
                </div>
                <div class="col-3">
                    <input wire:model.debounce.200ms="endDate" type="datetime-local" max="3000-01-01T23:59" class="form-control text-uppercase" />
                </div>
                <div class="col-2">
                    <select wire:model="pageSize" class="form-select" aria-label="Default select example">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
            </div>

            <div class="row">

                @foreach($visitors as $visitor)
                <div class="col-sm-6 mb-2">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4">
                                    <img src="{{$visitor->photo}}" class="w-100">
                                </div>
                                <div class="col-8">
                                    <div class="row">
                                        <div class="col-12">
                                            {{$visitor->person->name}}
{{--                                            </strong>--}}
                                        </div>
                                        <div class="col-12">
                                            {{$visitor->sector->name}}
{{--                                            </strong>--}}
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-12">
                                                <div class="small fw-bold">
                                                    <i class="fas fa-calendar-day me-2"></i>Entrada
                                                    <strong>
                                                        {{$visitor->entranced_at->format('d/m/Y - H:i')}}
                                                    </strong>
                                                </div>

                                            </div>
                                            <div class="col-12">
                                                <div class="small fw-bold">

                                                    {{ is_null($visitor->exited_at) ? dd($visitor) : ''}}

                                                    <i class="fas fa-calendar-day me-2"></i>Saída <strong>{{$visitor->exited_at->format('d/m/Y - H:i')}}</strong>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                @endForEach

                <div class="d-flex justify-content-center">
                    {{ $visitors->links() }}
                </div>
            </div>





        </div>




    </div>

</div>

@include('partials.button-to-top')
</div>
