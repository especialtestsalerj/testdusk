<?php

namespace App\Http\Livewire\Dashboard;

use App\Data\Repositories\Sectors;
use App\Models\Reservation as ReservationModel;
use Asantibanez\LivewireCharts\Models\AreaChartModel;
use Asantibanez\LivewireCharts\Models\ColumnChartModel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class Reservation extends Component
{
    public ?int $getReservationCount = null;
    public ?int $todayReservationCount = null;
    public ?int $futureReservationCount = null;
    public string $setorSelecionado = 'todos';

    protected ?ColumnChartModel $columnChartModel = null;
    protected ?AreaChartModel $areaChartModel = null;

    public function mount(): void
    {
        $this->atualizarDados();
    }

    public function atualizarDados(): void
    {
        $today = Carbon::today();
        $user = auth()->user();

        $query = ReservationModel::query();

        // Filtrar setores para usuários não administradores
        if (!$user->isAn('Administrador')) {
            $userSectorIds = $user->sectors->pluck('id')->toArray();
            $query->whereIn('sector_id', $userSectorIds);
        }

        // Aplicar filtro de setor selecionado
        if ($this->setorSelecionado !== 'todos') {
            $query->where('sector_id', $this->setorSelecionado);
        }

        // Contagens de agendamentos
        $this->getReservationCount = $query->count();
        $this->todayReservationCount = (clone $query)->whereDate('reservation_date', $today)->count();
        $this->futureReservationCount = (clone $query)->whereDate('reservation_date', '>', $today)->count();

        // Atualizar gráficos
        $this->atualizarGraficos(clone $query);
    }

    private function atualizarGraficos(Builder $query): void
    {
        $this->columnChartModel = $this->gerarGraficoPorDia($query);
        $this->areaChartModel = $this->gerarGraficoPorMes($query);
    }

    private function gerarGraficoPorDia(Builder $query): ColumnChartModel
    {
        $diasSemana = [
            0 => 'Domingo',
            1 => 'Segunda',
            2 => 'Terça',
            3 => 'Quarta',
            4 => 'Quinta',
            5 => 'Sexta',
            6 => 'Sábado',
        ];

        $agendamentosPorDia = $query->selectRaw('EXTRACT(DOW FROM reservation_date) as dia_semana, COUNT(*) as total')
            ->groupBy('dia_semana')
            ->orderBy('dia_semana')
            ->pluck('total', 'dia_semana')
            ->all();

        $columnChartModel = (new ColumnChartModel())
            ->setTitle('Agendamentos por Dia')
            ->setAnimated(true)
            ->setOpacity(0.9)
            ->setColumnWidth(70)
            ->withoutLegend()
            ->setDataLabelsEnabled(true);

        foreach ($diasSemana as $diaNumero => $diaNome) {
            $total = $agendamentosPorDia[$diaNumero] ?? 0;
            $color = '#' . substr(md5($diaNome), 0, 6);
            $columnChartModel->addColumn($diaNome, $total, $color);
        }

        return $columnChartModel;
    }

    private function gerarGraficoPorMes(Builder $query): AreaChartModel
    {
        $meses = [
            1 => 'Jan', 2 => 'Fev', 3 => 'Mar', 4 => 'Abr', 5 => 'Mai', 6 => 'Jun',
            7 => 'Jul', 8 => 'Ago', 9 => 'Set', 10 => 'Out', 11 => 'Nov', 12 => 'Dez',
        ];

        $agendamentosPorMes = $query->selectRaw('EXTRACT(MONTH FROM reservation_date) as mes, COUNT(*) as total')
            ->groupBy('mes')
            ->orderBy('mes')
            ->pluck('total', 'mes')
            ->all();

        $areaChartModel = (new AreaChartModel())
            ->setTitle('Agendamentos Mensais')
            ->setXAxisVisible(true)
            ->setYAxisVisible(true);

        foreach ($meses as $mesNumero => $mesNome) {
            $total = $agendamentosPorMes[$mesNumero] ?? 0;
            $areaChartModel->addPoint($mesNome, $total);
        }

        return $areaChartModel;
    }

    public function updatedSetorSelecionado(): void
    {
        $this->atualizarDados();
    }

    public function render()
    {
        $user = auth()->user();

        $sectors = $user->isAn('Administrador')
            ? app(Sectors::class)->allForUser()
            : $user->sectors;

        return view('livewire.dashboard.reservation', [
            'columnChartModel'       => $this->columnChartModel,
            'areaChartModel'         => $this->areaChartModel,
            'getReservationCount'    => $this->getReservationCount,
            'todayReservationCount'  => $this->todayReservationCount,
            'futureReservationCount' => $this->futureReservationCount,
            'sectors'                => $sectors,
        ]);
    }
}
