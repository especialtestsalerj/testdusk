<?php

namespace App\Http\Controllers;

use App\Data\Repositories\Reservations as ReservationRepository;
use App\Data\Repositories\Sectors;
use App\Http\Requests\AgendamentoStore;
use App\Http\Requests\Request;

use App\Models\Sector as SectorModel;

use Carbon\Carbon;
use Faker\Provider\Base;
use Illuminate\Routing\Controller as BaseController;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;


class Reservations extends BaseController
{
    public function create()
    {


        return view('agendamento.index') ;
    }

    public function createTailwind()
    {
        app(AuthenticatedSessionController::class)->destroy(request());
        return view('agendamento.form-tailwind') ;
    }

    public function createGroup()
    {
        app(AuthenticatedSessionController::class)->destroy(request());
        return view('agendamento.form-group') ;
    }

    public function index()
    {
        $reservations = app(ReservationRepository::class)->all();
        return view('reservations.index')->with('reservations',$reservations);
    }

    public function configuration()
    {
        return view('reservations.configuration');
    }

    public function store(AgendamentoStore $request)
    {


        $data = $request->all();
        $dataCarbon = Carbon::createFromFormat('d/m/Y', $data['reservation_date']);

        $data['reservation_date'] = $dataCarbon->format('Y-m-d');

        SectorModel::disableGlobalScopes();
        $data['building_id'] =SectorModel::find($data['sector_id'])->building_id;
        SectorModel::enableGlobalScopes();



//        dd($data);

        $person = [
            'full_name' => $request->get('full_name'),
            'social_name'=>$request->get('social_name'),
            'document_type_id'=>$request->get('document_type_id'),
            'document_number'=>$request->get('document_number'),
            'country_id'=>$request->get('country_id'),
            'state_id'=>$request->get('state_id'),
            'city_id'=>$request->get('city_id'),
            'other_city'=>$request->get('other_city'),
            'email'=>$request->get('responsible_email'),
            'mobile'=>$request->get('mobile'),
            'has_disability'=>$request->get('has_disability'),
            'disabilities'=>$request->get('disabilities')

        ];

//        dd($person);


       $data = array_merge($data, ['reservation_type_id'=> '1', 'code'=>generate_code(), 'reservation_status_id'=> '1', 'person'=>json_encode($person), ]);


        app(ReservationRepository::class)->create($data);

        return redirect()
            ->route('agendamento.detail')
            ->with('message', 'Setor adicionado com sucesso!');
    }

    public function calendar()
    {
        return view('reservations.calendar');
    }

    public function associateUser()
    {
        return view('reservations.association');
    }

}
