<?php

namespace App\Http\Livewire\Dashboard;

use Asantibanez\LivewireCharts\Models\AreaChartModel;
use Asantibanez\LivewireCharts\Models\ColumnChartModel;
use Asantibanez\LivewireCharts\Models\PieChartModel;
use Asantibanez\LivewireCharts\Models\RadarChartModel;
use Asantibanez\LivewireCharts\Models\TreeMapChartModel;
use Livewire\Component;

class Reservation extends Component
{
    public $totalAgendamentos;
    public $proximosAgendamentos;
    protected $columnChartModel;
    protected $pieChartModel;
    protected $areaChartModel;
    protected $radarChartModel;
    protected $treeMapChartModel;

    public function mount()
    {
        $this->totalAgendamentos = \App\Models\Reservation::count();

        $this->pieChartModel = (new PieChartModel())
            ->setTitle('Agendamentos por Dia')
            ->addSlice('Segunda', 10, '#f6ad55')
            ->addSlice('Terça', 15, '#fc8181')
            ->addSlice('Quarta', 12, '#90cdf4')
            ->addSlice('Quinta', 8, '#66DA26')
            ->addSlice('Sexta', 20, '#fc8181')
            ->addSlice('Sábado', 5, '#f6ad55')
            ->addSlice('Domingo', 2, '#90cdf4');

        $this->columnChartModel = (new ColumnChartModel())
            ->setTitle('Agendamentos por Dia')
            ->setAnimated(true)
            ->setOpacity(0.9)
            ->setColumnWidth(70) // Ajusta a largura das colunas
            ->withoutLegend() // Oculta a legenda
            ->setDataLabelsEnabled(true) // Exibe os valores nas colunas
            ->addColumn('Segunda', 10, '#f6ad55')
            ->addColumn('Terça', 15, '#fc8181')
            ->addColumn('Quarta', 12, '#90cdf4')
            ->addColumn('Quinta', 8, '#66DA26')
            ->addColumn('Sexta', 20, '#fc8181')
            ->addColumn('Sábado', 5, '#f6ad55')
            ->addColumn('Domingo', 2, '#90cdf4');



        $this->areaChartModel = (new AreaChartModel())
            ->setTitle('Crescimento de Vendas')
            ->setXAxisVisible(true)
            ->setYAxisVisible(true)
            ->addPoint('Janeiro', 100)
            ->addPoint('Fevereiro', 150)
            ->addPoint('Março', 200)
            ->addPoint('Abril', 250)
            ->addPoint('Maio', 300)
            ->addPoint('Junho', 350)
            ->withOnPointClickEvent('onPointClick1');


        $this->radarChartModel = (new RadarChartModel())
            ->setTitle('Métricas de Desempenho')
            ->addSeries('2019', 'Qualidade', 80)
            ->addSeries('2019', 'Velocidade', 70)
            ->addSeries('2019', 'Confiabilidade', 90)
            ->addSeries('2019', 'Custo', 60)
            ->addSeries('2020', 'Qualidade', 85)
            ->addSeries('2020', 'Velocidade', 75)
            ->addSeries('2020', 'Confiabilidade', 95)
            ->addSeries('2020', 'Custo', 65)
            ->withOnPointClickEvent('onPointClick2');

        $this->treeMapChartModel = (new TreeMapChartModel())
            ->setTitle('Vendas por Região')
            ->addBlock('América do Norte', 1000)
            ->addBlock('Europa', 800)
            ->addBlock('Ásia', 1200)
            ->addSeriesBlock('América do Norte', 'EUA', 600)
            ->addSeriesBlock('América do Norte', 'Canadá', 400)
            ->addSeriesBlock('Europa', 'Alemanha', 300)
            ->addSeriesBlock('Europa', 'França', 500)
            ->addSeriesBlock('Ásia', 'China', 700)
            ->addSeriesBlock('Ásia', 'Japão', 500)
            ->setDistributed(true)
            ->withOnBlockClickEvent('onBlockClick');

    }

    public function onPointClick1($point)
    {
        // Manipule o evento de clique no ponto
        $this->dispatchBrowserEvent('alert', [
            'message' => 'Você clicou em ' . $point['title'] . ' com valor ' . $point['value'],
        ]);
    }

    public function onBlockClick($block)
    {
        // Manipule o evento de clique no bloco
        $this->dispatchBrowserEvent('alert', [
            'message' => 'Você clicou em ' . $block['title'] . ' com valor ' . $block['value'],
        ]);
    }

    public function onPointClick2($point)
    {
        // Manipule o evento de clique no ponto
        $this->dispatchBrowserEvent('alert', [
            'message' => 'Você clicou em ' . $point['title'] . ' com valor ' . $point['value'],
        ]);
    }


    public function render()
    {
        return view('livewire.dashboard.reservation', [
            'pieChartModel' => $this->pieChartModel,
            'columnChartModel' => $this->columnChartModel,
            'areaChartModel' => $this->areaChartModel,
            'radarChartModel' => $this->radarChartModel,
            'treeMapChartModel' => $this->treeMapChartModel,
        ]);
    }
}




