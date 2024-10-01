<div class="container mt-5">
    <div class="row">
        <!-- Cartões de Resumo -->
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3">
                <div class="card-header">Total de Agendamentos</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $totalAgendamentos }}</h5>
                </div>
            </div>
        </div>
        <!-- Repita para outros cartões -->
    </div>

    <div class="row">
        <!-- Gráfico de Agendamentos -->
        <div class="col-md-6" >
            <div class="card mb-4">
                <div class="card-header">Agendamentos por Dia</div>

                <div style="height: 32rem;">
                    <livewire:livewire-column-chart
                        key="{{ $columnChartModel->reactiveKey() }}"
                        :column-chart-model="$this->columnChartModel"

                    />
                </div>
            </div>

        </div>

        <div class="col-md-6" >
            <div class="card mb-4">
                <div class="card-header">Agendamentos por Dia</div>

                <div style="height: 32rem;">
                    <livewire:livewire-pie-chart
                        key="{{ $pieChartModel->reactiveKey() }}"
                        :pie-chart-model="$pieChartModel"
                    />
                </div>
            </div>

        </div>

        <div class="col-md-6" >
            <div class="card mb-4">
                <div class="card-header">Agendamentos por Dia</div>

                <div style="height: 32rem;">
                    <livewire:livewire-area-chart
                        :area-chart-model="$areaChartModel"
                    />
                </div>
            </div>

        </div>

        <div class="col-md-6" >
            <div class="card mb-4">
                <div class="card-header">Agendamentos por Dia</div>

                <div style="height: 32rem;">
                    <livewire:livewire-radar-chart
                        :radar-chart-model="$radarChartModel"
                    />
                </div>
            </div>

        </div>

        <div class="col-md-6" >
            <div class="card mb-4">
                <div class="card-header">Agendamentos por Dia</div>

                <div style="height: 32rem;">
                    <livewire:livewire-tree-map-chart
                        :tree-map-chart-model="$treeMapChartModel"
                    />
                </div>
            </div>

        </div>

    </div>

</div>
