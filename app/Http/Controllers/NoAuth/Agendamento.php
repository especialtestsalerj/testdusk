<?php

namespace App\Http\Controllers\NoAuth;

use App\Data\Repositories\Reservations as ReservationRepository;
use App\Data\Repositories\Sectors;
use App\Http\Requests\AgendamentoIndex;
use App\Http\Requests\AgendamentoRecover;
use App\Http\Requests\AgendamentoStore;

use App\Models\Reservation;
use App\Models\Sector as SectorModel;

use App\Notifications\ReservationResendNotification;
use App\Services\reCaptcha\RecaptchaEnterpriseService;
use Carbon\Carbon;
use Faker\Provider\Base;
use Illuminate\Http\Request as Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Routing\Controller as BaseController;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;

use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;


class Agendamento extends BaseController
{
    protected $recaptchaService;

    public function __construct(RecaptchaEnterpriseService $recaptchaService)
    {
        $this->recaptchaService = $recaptchaService;
    }
    public function create()
    {


        return view('agendamento.index') ;
    }

    public function createTailwind()
    {
        app(AuthenticatedSessionController::class)->destroy(request());
        return view('agendamento.form-tailwind') ;
    }

    public function createForm(AgendamentoIndex $request)
    {
        $building_id = $request->get('building_id');
        app(AuthenticatedSessionController::class)->destroy(request());
        return view('agendamento.form')->with('building_id', $building_id) ;
    }

    public function index()
    {
        $reservations = app(ReservationRepository::class)->all();
        return view('reservations.index')->with('reservations',$reservations);
    }

    private function validateRecaptcha($token)
    {


        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => config('services.recaptcha.secret_key'),
            'response' => $token,
        ]);

        return $response->json();
    }

    public function recover(AgendamentoRecover $request)
    {
//        dd($request);


        // Valide o reCAPTCHA
        $response = $this->validateRecaptcha($request->input('g-recaptcha-response'));

        if ($response['success']) {
            $documentNumber = remove_punctuation($request->get('documentNumber'));


            $reservations = app(ReservationRepository::class)->recoveryFromDocument($documentNumber);


            if (count($reservations) > 0) {

                Notification::route('mail', $reservations[0]->responsible_email)
                    ->notify(new ReservationResendNotification($reservations));
            }

            return redirect()
                ->route('agendamento.index')
                ->with('message', 'Seus agendamentos foram enviados para o e-mail cadastrado. Caso possua agendamento(s).');
        }else{
        // Caso contrário, retorne um erro
           return back()->withErrors(['recaptcha' => 'Erro ao validar o reCAPTCHA. Tente novamente.']);
        }
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
            ->with([
                'message' => 'Reserva adicionado com sucesso!',
                'reservation' => $reservation
            ]);
    }


    public function detail($uuid)
    {
        $reservation = Reservation::where('uuid', $uuid)->firstOrFail();

        return view('agendamento.detail')->with([
            'reservation' => $reservation
        ]);
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
