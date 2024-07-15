<?php

namespace App\Http\Livewire\Reservations;

use App\Http\Livewire\Reservation\Form;
use Livewire\Component;

class FormGroup extends Form
{

    public $inputs = [];
    public function render()
    {
        $this->loadCountryBr();
        $this->loadDefaultLocation();

        return view('livewire.reservations.form-group')->with($this->getViewVariables());
    }

    public function addInput()
    {
        $this->inputs[] = ['cpf' => '', 'name' => '','documentType'=>''];


    }

    public function removeInput($index)
    {
        unset($this->inputs[$index]);

        $this->inputs = array_values($this->inputs); // Reindexa o array
    }

    protected function loadHourCapacities()
    {


        if(!empty($this->sector_id) && !empty($this->reservation_date)) {

            $date = \DateTime::createFromFormat('d/m/Y', $this->reservation_date)->format('Y-m-d');


            $this->capacities =  \DB::table('capacities as c')
                ->select('c.id', \DB::raw("c.hour, c.hour || ' (' || (c.maximum_capacity - (
             select COALESCE(sum(r.quantity),0) from reservations r
            where r.sector_id = c.sector_id
              and r.reservation_date = '$date'
              and r.capacity_id = c.id)) || ' vagas)' as maximum_capacity"))
                ->where('c.sector_id', $this->sector_id)
                ->having(\DB::raw("(c.maximum_capacity - (
        select COALESCE(sum(r.quantity),0) from reservations r
        where r.sector_id = c.sector_id
          and r.reservation_date = '$date'
          and r.capacity_id = c.id))"), '>', 0)
                ->groupBy('c.id', 'c.hour', 'c.maximum_capacity')
                ->orderBy('c.hour')
                ->get();
        }
        else{
            $this->capacities =[];
        }
    }


    public function loadDates()
    {
//        dump('datas');
        parent::loadDates();
//        $this->emit('load');
    }
}
