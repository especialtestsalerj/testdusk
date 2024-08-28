<?php

namespace App\Http\Controllers\NoAuth;

use App\Data\Repositories\Reservations as ReservationRepository;
use App\Data\Repositories\Sectors;
use App\Http\Requests\AgendamentoStore;

use App\Models\Reservation;
use App\Models\Sector as SectorModel;

use App\Notifications\ReservationResendNotification;
use Carbon\Carbon;
use Faker\Provider\Base;
use Illuminate\Http\Request as Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Routing\Controller as BaseController;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;


class Agendamento extends BaseController
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

    public function recover(Request $request)
    {

        $documentNumber = remove_punctuation($request->get('documentNumber'));
        $email = $request->get('email');
       $reservations = app(ReservationRepository::class)->recoveryFromDocumentAndEmail($documentNumber,$email);


        if(count($reservations) > 0) {

            Notification::route('mail', $reservations[0]->responsible_email)
                ->notify(new ReservationResendNotification($reservations));
        }

        return redirect()
            ->route('agendamento.index')
            ->with('message', 'Reservas enviadas, caso os dados estejam corretos!');
    }

    public function store(AgendamentoStore $request)
    {


        $data = $request->all();
        $dataCarbon = Carbon::createFromFormat('d/m/Y', $data['reservation_date']);

        $data['reservation_date'] = $dataCarbon->format('Y-m-d');

        SectorModel::disableGlobalScopes();
        $data['building_id'] =SectorModel::find($data['sector_id'])->building_id;
        SectorModel::enableGlobalScopes();



        $group = $request->input('inputs', []);

        $data['quantity'] = count($group) +1;


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
            'disabilities'=>$request->get('disabilities'),
            'birthdate'=>$request->get('birthdate'),

        ];

        $data['guests'] = $request->input('inputs', []);

       $data = array_merge($data, ['reservation_type_id'=> '1', 'code'=>generate_code(), 'reservation_status_id'=> '1', 'person'=>$person, ]);

        $reservation = app(ReservationRepository::class)->create($data);

        return view('agendamento.detail')
            ->with(['message'=> 'Setor adicionado com sucesso!',
                    'reservation' =>$reservation]);
    }


    public function detail()
    {
        return view('agendamento.detail');
    }

    public function cancel($uuid)
    {
        $reservation = Reservation::where('uuid', $uuid)->firstOrFail();

        // Lógica para cancelar a reserva
        $reservation->reservation_status_id = 5; // Status "cancelado"
        $reservation->save();

        return redirect()->route('agendamento.index')->with('status', 'Reservation canceled successfully.');
    }
}
