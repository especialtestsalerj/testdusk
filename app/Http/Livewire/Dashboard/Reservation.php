<?php

namespace App\Http\Livewire\Dashboard;

use App\Data\Repositories\Sectors;
use App\Models\Reservation as ReservationModel;
use Asantibanez\LivewireCharts\Models\AreaChartModel;
use Asantibanez\LivewireCharts\Models\ColumnChartModel;
use Carbon\Carbon;
use DateInterval;
use DatePeriod;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Reservation extends Component
{
    public ?int $getReservationCount = null;
    public ?int $todayReservationCount = null;
    public ?int $futureReservationCount = null;
    public string $setorSelecionado = 'todos';

    protected ?ColumnChartModel $columnChartModel = null;
    protected ?AreaChartModel $areaChartModel = null;
    public $todaySchedules;

    public $aguardandoConfirmacaoCount;
    public $visitaAgendadaCount;
    public $visitaEmAndamentoCount;
    public $visitaRealizadaCount;
    public $visitaCanceladaCount;
    public $aguardandoConfirmacaoVisitanteCount;

    public function mount(): void
    {
        $this->atualizarDados();
    }

    public function atualizarDados(): void
    {
        $today = Carbon::today();
        $user = auth()->user();

        $query = ReservationModel::where('reservations.building_id', get_current_building()->id);

        // Filtrar setores para usuários não administradores
        if (!$user->isAn('Administrador')) {
            $userSectorIds = $user->sectors->pluck('id')->toArray();
            $query->whereIn('reservations.sector_id', $userSectorIds);
        }

        // Aplicar filtro de setor selecionado
        if ($this->setorSelecionado !== 'todos') {
            $query->where('reservations.sector_id', $this->setorSelecionado);
        }

        $this->atualizarGraficos(clone $query);
        $this->buscarHorariosAgendadosHoje(clone $query);

        $this->todayReservationCount = (clone $query)->whereDate('reservation_date', $today)->count();
        $this->futureReservationCount = (clone $query)->whereDate('reservation_date', '>', $today)->count();
        $this->getReservationCount = $query->count();

        // Obter a quantidade de reservas por status
        $statusCounts = (clone $query)
            ->select('reservation_status_id', DB::raw('COUNT(*) as total'))
            ->groupBy('reservation_status_id')
            ->pluck('total', 'reservation_status_id')
            ->all();

        $this->aguardandoConfirmacaoCount = $statusCounts[1] ?? 0;
        $this->visitaAgendadaCount = $statusCounts[2] ?? 0;
        $this->visitaEmAndamentoCount = $statusCounts[3] ?? 0;
        $this->visitaRealizadaCount = $statusCounts[4] ?? 0;
    }


    public function buscarHorariosAgendadosHoje($query)
    {
        $today = Carbon::today();

        $documentTypes = [
            1 => 'CPF',
            4 => 'Passaporte',
        ];

        $reservations = $query
            ->whereIn('reservation_status_id', [2, 3, 4])
            ->join('capacities', 'reservations.capacity_id', '=', 'capacities.id')
            ->join('sectors', 'reservations.sector_id', '=', 'sectors.id')
            ->whereDate('reservation_date', $today)
            ->select('reservations.*', 'capacities.hour as reservation_time', 'sectors.name as sector_name')
            ->orderBy('capacities.hour')
            ->get();

        // Agrupa as reservas por horário e setor
        $groupedReservations = $reservations->groupBy(function($item) {
            return $item->reservation_time . '|' . $item->sector_name;
        });

        $this->todaySchedules = [];

        foreach ($groupedReservations as $key => $group) {
            $total_reservations = $group->sum('quantity');

            // Coleta todas as pessoas deste grupo
            $people = [];

            foreach ($group as $reservation) {
                // Analisa o JSON da coluna 'person'
                $personData = $reservation->person;
                if ($personData) {
                    $documentTypeId = $personData['document_type_id'];
                    $documentTypeName = isset($documentTypes[$documentTypeId]) ? $documentTypes[$documentTypeId] : 'Desconhecido';

                    $people[] = [
                        'name' => $personData['full_name'],
                        'document' => $personData['document_number'],
                        'document_type' => $documentTypeName
                    ];
                }

                // Analisa o JSON da coluna 'guests'
                $guestsData = $reservation->guests;
                if ($guestsData) {
                    foreach ($guestsData as $guest) {
                        $documentTypeId = $guest['documentType'];
                        $documentTypeName = isset($documentTypes[$documentTypeId]) ? $documentTypes[$documentTypeId] : 'Desconhecido';

                        $people[] = [
                            'name' => $guest['name'],
                            'document' => $guest['document'],
                            'document_type' => $documentTypeName
                        ];
                    }
                }
            }

            // Extrai horário e nome do setor da chave
            list($reservation_time, $sector_name) = explode('|', $key);

            $this->todaySchedules[] = [
                'reservation_time' => $reservation_time,
                'sector_name' => $sector_name,
                'total_reservations' => $total_reservations,
                'people' => $people
            ];
        }
    }



    private function atualizarGraficos(Builder $query): void
    {
        $this->areaChartModel = $this->gerarGraficoPorMes($query);
        $this->columnChartModel = $this->gerarGraficoPorDia($query);
    }

    private function gerarGraficoPorDia(Builder $query): ColumnChartModel
    {
        $startDate = Carbon::today();
        $endDate = Carbon::today()->addDays(6);

        // Gerar uma lista de datas de hoje até os próximos 6 dias
        $period = new DatePeriod(
            $startDate,
            new DateInterval('P1D'),
            $endDate->addDay() // Adiciona um dia para incluir o endDate
        );

        $diasSemana = [
            'Sunday' => 'Domingo',
            'Monday' => 'Segunda',
            'Tuesday' => 'Terça',
            'Wednesday' => 'Quarta',
            'Thursday' => 'Quinta',
            'Friday' => 'Sexta',
            'Saturday' => 'Sábado',
        ];

        $datas = [];
        foreach ($period as $date) {
            $englishDayName = $date->format('l');
            $diaNome = $diasSemana[$englishDayName];
            $formattedDate = $date->format('d/m');
            $label = $diaNome . ' (' . $formattedDate . ')';
            $datas[$date->format('Y-m-d')] = [
                'label' => $label,
                'diaNome' => $diaNome, // Usaremos isso para gerar a cor
            ];
        }

        // Obter o total de agendamentos por data
        $agendamentosPorData = $query
            ->whereBetween('reservation_date', [$startDate, $endDate])
            ->selectRaw('DATE(reservation_date) as data_reserva, COUNT(*) as total')
            ->groupBy('data_reserva')
            ->orderBy('data_reserva')
            ->pluck('total', 'data_reserva')
            ->all();

        $columnChartModel = (new ColumnChartModel())
            ->setTitle('Quantidade de agendamentos')
            ->setAnimated(true)
            ->setOpacity(0.9)
            ->setColumnWidth(70)
            ->withoutLegend()
            ->setDataLabelsEnabled(true);

        // Construir o gráfico com os dados ordenados a partir de hoje
        foreach ($datas as $data => $info) {
            $label = $info['label'];
            $diaNome = $info['diaNome'];
            $total = $agendamentosPorData[$data] ?? 0;
            $color = '#' . substr(md5($diaNome), 0, 6); // Gera a cor baseada no nome do dia da semana
            $columnChartModel->addColumn($label, $total, $color);
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
            'columnChartModel' => $this->columnChartModel,
            'areaChartModel' => $this->areaChartModel,
            'getReservationCount' => $this->getReservationCount,
            'todayReservationCount' => $this->todayReservationCount,
            'futureReservationCount' => $this->futureReservationCount,
            'sectors' => $sectors,
            'todaySchedules' => $this->todaySchedules,
        ]);
    }
}
