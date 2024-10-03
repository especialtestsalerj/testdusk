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
                    <div class="card-header text-white bg-dark2">Agendamentos confirmados para hoje</div>
                    <div class="card-body">
                        @if(empty($todaySchedules))
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
                                @foreach($todaySchedules as $index => $schedule)
                                    <tr>
                                        <td>{{ $schedule['sector_name'] }}</td>
                                        <td>{{ \Carbon\Carbon::parse($schedule['reservation_time'])->format('H:i') }}</td>
                                        <td class="text-center">
                                            <!-- Botão para abrir o modal -->
                                            <a href="#" data-bs-toggle="modal"
                                               data-bs-target="#peopleModal{{ $index }}">
                                                {{ $schedule['total_reservations'] }}
                                            </a>

                                            <!-- Modal para exibir os detalhes das pessoas -->
                                            <div class="modal fade" id="peopleModal{{ $index }}" tabindex="-1"
                                                 role="dialog" aria-labelledby="peopleModalLabel{{ $index }}"
                                                 aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="peopleModalLabel{{ $index }}">
                                                                Detalhes das Pessoas</h5>

                                                            <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Fechar">
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <table class="table table-striped">
                                                                <thead>
                                                                <tr>
                                                                    <th>Nome</th>
                                                                    <th>Tipo de Documento</th>
                                                                    <th>Documento</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @foreach($schedule['people'] as $person)
                                                                    <tr>
                                                                        <td>{{ $person['name'] }}</td>
                                                                        <td>{{ $person['document_type'] }}</td>
                                                                        <td>{{ $person['document'] }}</td>
                                                                    </tr>
                                                                @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
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

