<?php

namespace App\Http\Controllers;

use App\Data\Repositories\Reservations as ReservationRepository;
use App\Http\Requests\AgendamentoStore;
use App\Http\Requests\Request;
use Faker\Provider\Base;
use Illuminate\Routing\Controller as BaseController;


class Reservations extends BaseController
{
    public function create()
    {
        return view('reservations.form') ;
    }

    public function index()
    {
        $reservations = app(ReservationRepository::class)->all();
        return view('reservations.index')->with('reservations',$reservations);
    }

    public function store(AgendamentoStore $request)
    {
        $data = $request->all();

        $person = [
            'full_name' => $request->get('full_name'),
            'social_name'=>$request->get('social_name'),
            'document_type_id'=>$request->get('document_type_id'),
            'document_number'=>$request->get('document_number'),
            'country_id'=>$request->get('country_id'),
            'state_id'=>$request->get('state_id'),
            'city_id'=>$request->get('city_id'),
            'other_city'=>$request->get('other_city'),
            'email'=>$request->get('email'),
            'mobile'=>$request->get('mobile'),
        ];




       $data = array_merge($data, ['reservation_type_id'=> '1', 'code'=>generate_code(), 'reservation_status_id'=> '1', 'person'=>json_encode($person), ]);


        app(ReservationRepository::class)->create($data);

        return redirect()
            ->route('reservation.form')
            ->with('message', 'Setor adicionado com sucesso!');
    }

}
