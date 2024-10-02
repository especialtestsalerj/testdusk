{{--<div class="container-fluid mt-5">--}}
{{--    <div class="row">--}}
{{--        <!-- Sidebar Esquerdo -->--}}
{{--        <div class="col-md-3">--}}
{{--            <!-- Horários Agendados para Hoje -->--}}
{{--            <div class="card mb-4">--}}
{{--                <div class="card-header text-white bg-dark2">Horários Agendados para Hoje</div>--}}
{{--                <div class="card-body">--}}
{{--                    <ul class="list-group list-group-flush">--}}

{{--                            <li class="list-group-item">10:00</li>--}}
{{--                            <li class="list-group-item">10:00</li>--}}
{{--                            <li class="list-group-item">10:00</li>--}}
{{--                            <li class="list-group-item">10:00</li>--}}
{{--                            <li class="list-group-item">10:00</li>--}}
{{--                            <li class="list-group-item">10:00</li>--}}

{{--                    </ul>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <!-- Conteúdo Principal -->--}}
{{--        <div class="col-md-9">--}}
{{--            <!-- Cartões de Resumo -->--}}
{{--            <div class="row">--}}
{{--                <div class="col-md-4">--}}
{{--                    <div class="card  mb-3">--}}
{{--                        <div class="card-header text-white bg-dark2">Total de Agendamentos</div>--}}
{{--                        <div class="card-body">--}}
{{--                            <h5 class="card-title">10</h5>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="col-md-4">--}}
{{--                    <div class="card mb-3">--}}
{{--                        <div class="card-header text-white bg-dark2">Agendamentos para Hoje</div>--}}
{{--                        <div class="card-body">--}}
{{--                            <h5 class="card-title">40</h5>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="col-md-4">--}}
{{--                    <div class="card mb-3">--}}
{{--                        <div class="card-header text-white bg-dark2">Agendamentos Futuros</div>--}}
{{--                        <div class="card-body">--}}
{{--                            <h5 class="card-title">60</h5>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <!-- Gráficos -->--}}
{{--            <div class="row">--}}
{{--                <div class="col-md-6">--}}
{{--                    <div class="card mb-4 ">--}}
{{--                        <div class="card-header text-white bg-dark2">Agendamentos por Dia</div>--}}
{{--                        <div class="card-body">--}}
{{--                            <div style="height: 32rem;">--}}
{{--                                <livewire:livewire-column-chart--}}
{{--                                    key="{{ $columnChartModel->reactiveKey() }}"--}}
{{--                                    :column-chart-model="$columnChartModel"--}}
{{--                                />--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="col-md-6">--}}
{{--                    <div class="card mb-4">--}}
{{--                        <div class="card-header text-white bg-dark2">Agendamentos por Dia</div>--}}
{{--                        <div class="card-body">--}}
{{--                            <div style="height: 32rem;">--}}
{{--                                <livewire:livewire-area-chart--}}
{{--                                    :area-chart-model="$areaChartModel"--}}
{{--                                />--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--    </div>--}}
{{--</div>--}}

<div class="container-fluid mt-5">
    <div class="row">
        <!-- Sidebar Esquerdo -->
        <div class="col-md-3">

            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="mb-3">
                        <div class="card-header text-white bg-dark2">Setores</div>

                        <div class="card-body">

                            <label for="setorSelect" class="form-label">Selecione o Setor</label>
                            <select id="setorSelect" class="form-select" wire:model="setorSelecionado">
                                @if(auth()->user()->isAn('Administrador') || auth()->user()->sectors->count() > 1)
                                    <option value="todos">Todos os Setores</option>
                                @endif
                                @foreach($sectors as $sector)
                                    <option value="{{ $sector->id }}">{{ $sector->nickname ?? $sector->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header text-white bg-dark2">Horários Agendados para Hoje</div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">

                            <li class="list-group-item">10:00</li>
                            <li class="list-group-item">10:00</li>
                            <li class="list-group-item">10:00</li>
                            <li class="list-group-item">10:00</li>
                            <li class="list-group-item">10:00</li>
                            <li class="list-group-item">10:00</li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-9">

            <div class="row">
                <div class="col-md-4">
                    <div class="card  mb-3">
                        <div class="card-header text-white bg-dark2">Total de Agendamentos</div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $getReservationCount }}</h5>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card mb-3">
                        <div class="card-header text-white bg-dark2">Agendamentos para Hoje</div>
                        <div class="card-body">
                            <h5 class="card-title">{{$todayReservationCount}}</h5>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card mb-3">
                        <div class="card-header text-white bg-dark2">Agendamentos Futuros</div>
                        <div class="card-body">
                            <h5 class="card-title">{{$futureReservationCount}}</h5>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Gráficos -->
            <div class="row">
                <div class="col-md-6">
                    <div class="card mb-4 ">
                        <div class="card-header text-white bg-dark2">Agendamentos por Dia</div>
                        <div class="card-body">
                            <div style="height: 32rem;">
                                <livewire:livewire-column-chart
                                    key="{{ $columnChartModel->reactiveKey() }}"
                                    :column-chart-model="$columnChartModel"
                                />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-header text-white bg-dark2">Agendamentos por Dia</div>
                        <div class="card-body">
                            <div style="height: 32rem;">
                                <livewire:livewire-area-chart
                                    :area-chart-model="$areaChartModel"
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

