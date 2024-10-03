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
                        @if($todaySchedules->isEmpty())
                            <p class="text-center">Nenhum agendamento para hoje.</p>
                        @else
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Setor</th>
                                    <th>Horário</th>
                                    <th class="text-center">Pessoas</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($todaySchedules as $schedule)
                                    <tr>
                                        <td>{{ $schedule->sector_name }}</td>
                                        <td>{{ \Carbon\Carbon::parse($schedule->reservation_time)->format('H:i') }}</td>
                                        <td class="text-center">{{ $schedule->total_reservations }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>

        </div>

        <div class="col-md-9">

            <div class="row">
                <div class="col-md-2">
                    <div class="card  mb-3">
                        <div class="card-header text-white bg-dark2">Total de Agendamentos</div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $getReservationCount }}</h5>
                        </div>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="card mb-3">
                        <div class="card-header text-white bg-dark2">Agendamentos para Hoje</div>
                        <div class="card-body">
                            <h5 class="card-title">{{$todayReservationCount}}</h5>
                        </div>
                    </div>
                </div>

                <!-- Card: Visita em Andamento -->
                <div class="col-md-2">
                    <div class="card mb-3">
                        <div class="card-header text-white bg-dark2">Visitas em Andamento</div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $visitaEmAndamentoCount }}</h5>
                        </div>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="card mb-3">
                        <div class="card-header text-white bg-dark2">Agendamentos Futuros</div>
                        <div class="card-body">
                            <h5 class="card-title">{{$futureReservationCount}}</h5>
                        </div>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="card mb-3">
                        <div class="card-header text-white bg-dark2">Aguardando Confirmação</div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $aguardandoConfirmacaoCount }}</h5>
                        </div>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="card mb-3">
                        <div class="card-header text-white bg-dark2">Total de visitas realizadas</div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $visitaRealizadaCount }}</h5>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Gráficos -->
            <div class="row">
                <div class="col-md-6">
                    <div class="card mb-4 ">
                        <div class="card-header text-white bg-dark2">Agendamentos para os próximos 7 dias</div>
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
                        <div class="card-header text-white bg-dark2">Agendamentos Mensais</div>
                        <div class="card-body">
                            <div style="height: 32rem;">
                                <livewire:livewire-area-chart
                                    key="{{ $areaChartModel->reactiveKey() }}"
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

