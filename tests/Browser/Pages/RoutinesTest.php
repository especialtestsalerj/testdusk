<?php

namespace Tests\Feature;

use App\Data\Repositories\Routines;
use App\Models\User;
use App\Models\Routine;
use App\Models\EventType;
use App\Models\Sector;
use App\Models\Visitor;
use App\Support\Constants;
use Carbon\Carbon;
use Livewire\Livewire;
use App\Http\Livewire\People\People;
use App\Http\Livewire\Routines\Index;
use Illuminate\Support\Facades\DB;
use Tests\DuskTestCase;
use Tests\Browser\Pages\Page;
use Faker\Factory as Faker;


class RoutinesTest extends DuskTestCase
{
    use Page;

    protected function setUp(): void
    {
        parent::setUp();
        foreach (static::$browsers as $browser) {
            $browser->driver->manage()->deleteAllCookies();
        }
    }

    protected function tearDown(): void
    {
        $this->browse(function ($browser) {
            $browser->logout();
        });
        parent::tearDown();
    }

    /**
     * Cria e finaliza uma nova rotina.
     *
     * @test
     * @group CreateRoutine
     * @group link
     */
    public function testCreateRoutine()
    {
        $this->createRoutine();

        $this->finishOpenRoutine();
    }

    /**
     * Edição de uma nova rotina (finaliza no final do teste).
     *
     * @test
     * @group CreateRoutine
     * @group link
     */
    public function testEditRoutine()
    {
        $this->createRoutine();

        $routine = Routine::where('status', true)->inRandomOrder()->first(); // Rotina em aberto

        // Edita a rotina (em aberto)
        $this->browse(function ($browser) use ($routine) {
            $browser
                ->visit('/routines')
                ->assertSee('Rotinas')
                ->screenshot('BeforeEditRoutine')
                ->press('@manageRoutine-' . $routine['id'])
                ->type('#checkpoint_obs', str_random(15))
                ->script("document.getElementById('entranced_at').value = '" . $this->getDateRoutine()->entranced_at
                        ->setDate(2023, rand(1, 12), rand(1, 30))->setTime(rand(8, 20), rand(1, 59), 0) . "'");
            $browser
                ->screenshot('EditRoutine')
                ->script('document.querySelectorAll("#submitButton")[0].click();');
            $browser
                ->assertPathIs('/routines')
                ->assertSee('Rotina alterada com sucesso!');
        });

        $this->finishOpenRoutine();
    }

    /**
     * Cria um novo evento.
     *
     * @test
     * @group CreateEvent
     * @group link
     */
    public function testCreateEvent()
    {
        $this->createRoutine();

        $routine = Routine::where('status', true)->inRandomOrder()->first(); // Rotina em aberto
        $occurred_at = $routine->entranced_at->format('Y-m-d H:i');

        $event_type = EventType::all()
            ->random(6)
            ->toArray()[0];
        $sector = Sector::all()
            ->random(6)
            ->toArray()[0];
        $duty_user = User::all()
            ->random(20)
            ->toArray()[0];

        $this->browse(function ($browser) use ($routine, $event_type, $sector, $duty_user, $occurred_at) {
            $browser
                ->visit('/routines')
                ->assertSee('Rotinas')
                ->press('@manageRoutine-' . $routine['id'])
                ->press('@newEvent')
                ->assertPathIs('/routines' . '/' . $routine['id'] . '/events/create')
                ->press('#submitButton')
                ->assertSee('Tipo: preencha o campo corretamente.')
                ->assertSee('Plantonista: preencha o campo corretamente.')
                ->assertSee('Observações: preencha o campo corretamente.')
                ->script("document.getElementById('occurred_at').value = '{$occurred_at}'");

            $browser
                ->select('#event_type_id', $event_type['id'])
                ->select('#sector_id', $sector['id'])
                ->select('#duty_user_id', $duty_user['id'])
                ->type('#description', str_random(15))
                ->press('#submitButton')
                ->assertPathIs('/routines/' . $routine['id'])
                ->assertSee('Ocorrência adicionada com sucesso!')
                ->screenshot('AddEvents');
        });

        $this->finishOpenRoutine();

    }

    /**
     * Cria um novo visitante.
     *
     * @test
     * @group CreateVisitor
     * @group link
     */
    public function testCreateVisitor()
    {
        $this->createRoutine();

        $routine = Routine::where('status', true)->inRandomOrder()->first(); // Rotina em aberto
        $entranced_at = $routine->entranced_at->format('Y-m-d H:i');

        $sector = Sector::all()
            ->random(6)
            ->toArray()[0];
        $duty_user = User::all()
            ->random(20)
            ->toArray()[0];

        //Adicionar visitante
        $this->browse(function ($browser) use ($entranced_at, $routine, $sector, $duty_user) {
            $browser
                ->visit('/routines')
                ->assertSee('Rotinas')
                ->press('@manageRoutine-' . $routine['id'])
                ->script('document.getElementById("newVisitor").click()');

            $browser
                ->assertPathIs('/routines' . '/' . $routine['id'] . '/visitors/create')
                ->press('#submitButton')
                ->assertSee('CPF (Visitante): preencha o campo corretamente.')
                ->assertSee('Nome (Visitante): preencha o campo corretamente.')
                ->assertSee('Plantonista: preencha o campo corretamente.')
                ->assertSee('Observações: preencha o campo corretamente.')
                ->script("document.getElementById('entranced_at').value = '{$entranced_at}'");
            $browser
                ->select('#sector_id', $sector['id'])
                ->select('#duty_user_id', $duty_user['id'])
                ->type('#cpf', Faker::create('pt_BR')->cpf())
                ->click('#btn_buscar')
                ->type('#description', Faker::create()->text(50))
                ->type('#full_name', Faker::create('pt_BR')->name())
                ->type('#origin', str_random(10))
                ->screenshot('Visitante na entrada')
                ->press('#submitButton')
                ->assertPathIs('/routines/' . $routine['id'])
                ->assertSee('Visitante adicionado/a com sucesso!');

            //Editar o visitante (e adicionar a saída dele)
            $browser
                ->click('#alterar')
                ->select('#sector_id', $sector['id'])
                ->select('#duty_user_id', $duty_user['id'])
                ->type('#cpf', Faker::create('pt_BR')->cpf())
                ->clear('#description')
                ->type('#description', Faker::create()->text(500))
                ->clear('#full_name')
                ->type('#full_name', Faker::create('pt_BR')->name())
                ->clear('#origin')
                ->type('#origin', 'origem')
                ->script("document.getElementById('entranced_at').value = '{$this->getDateRoutine()->entranced_at->addDay()->format('Y-m-d H:i')}'");
            $browser
                ->script("document.getElementById('exited_at').value = '{$this->getDateRoutine()->entranced_at->addDay(2)->format('Y-m-d H:i')}'");
            $browser
                ->screenshot('Visitante na saída')
                ->press('#submitButton')
                ->assertPathIs('/routines/' . $routine['id'])
                ->assertSee('Visitante alterado/a com sucesso!');

            //Excluir o visitante


        });

        $this->finishOpenRoutine();
    }


    /**
     * @test
     * @group testCreateEditStuffs
     * @group link
     */

    // Cria/Altera materiais dentro de uma rotina em aberto

    public function testCreateStuff()
    {
        $this->createRoutine();

        $routine = Routine::where('status', true)->inRandomOrder()->first(); // Rotina em aberto
        $entranced_at = $routine->entranced_at->format('Y-m-d H:i');
        //$exited_at = $routine->exited_at->format('Y-m-d H:i');

        $sector = Sector::all()
            ->random(1)
            ->toArray()[0];
        $duty_user = User::all()
            ->random(1)
            ->toArray()[0];

        $stuff = DB::table('stuffs')
            ->where('routine_id', '=', $routine['id'])
            ->first();

        $this->browse(function ($browser) use ($routine, $sector, $duty_user, $entranced_at, $stuff) {
            $browser
                ->visit('/routines')
                ->assertSee('Rotinas')
                ->press('@manageRoutine-' . $routine['id'])
                ->script('document.getElementById("newStuff").click()');
            $browser
                ->assertPathIs('/routines' . '/' . $routine['id'] . '/stuffs/create')
                ->screenshot('stuffs')
                ->press('#submitButton')
                ->assertSee('Plantonista: preencha o campo corretamente.')
                ->assertSee('Observações: preencha o campo corretamente.')
                ->script("document.getElementById('entranced_at').value = '{$entranced_at}'");
//            $browser
//                ->script("document.getElementById('exited_at').value = '{$exited_at}'");
            $browser
                ->select('#sector_id', $sector['id'])
                ->select('#duty_user_id', $duty_user['id'])
                ->type('#description', str_random(20))
                ->press('#submitButton')
                ->assertPathIs('/routines/' . $routine['id'])
                ->assertSee('Material adicionado com sucesso!');

            //EDIÇÃO DO MATERIAL - falta fazer
//            $browser
//                ->visit('/stuffs/' . $stuff->id)
//                ->type('#description', 'teste');
            // $this->insertDate(0, 'entranced_at');
            // $this->insertDate(1, 'exited_at');
            // $browser
            //     ->press('#submitButton')
            //     ->assertPathIs('/routines/' . $routine['id'])
            //     ->assertSee('Material alterado com sucesso!');

            //CRIAR E EXCLUIR MATERIAL - falta fazer
        });
        $this->finishOpenRoutine();
    }

//    /**
//     * @test
//     * @group testCreateEditCautions
//     * @group link
//     */
//
//    // Dusk - Cria/Altera uma Cautela de Armas detro de Rotina.
//
//    public function testCautions()
//    {
//        $user = User::factory()->create();
//        $user->assign(Constants::ROLE_ADMINISTRATOR);
//        $user->allow('*');
//        $user->save();
//        $routine = Routine::all()
//            ->where('status', '=>', 'true')
//            ->random(1)
//            ->toArray()[0];
//        $event_type = EventType::all()
//            ->random(1)
//            ->toArray()[0];
//        $sector = Sector::all()
//            ->random(1)
//            ->toArray()[0];
//        $duty_user = User::all()
//            ->random(1)
//            ->toArray()[0];
//        $visitor = Visitor::all()
//            ->random(1)
//            ->toArray()[0];
//
//        $this->browse(function ($browser) use (
//            $user,
//            $routine,
//            $event_type,
//            $sector,
//            $duty_user,
//            $visitor
//        ) {
//            $browser
//                ->loginAs($user->id)
//                ->visit('/routines')
//                ->assertSee('Rotinas')
//                ->press('@manageRoutine-' . $routine['id'])
//                ->press('@newCaution')
//                ->assertPathIs('/cautions/create/' . $routine['id'])
//                ->press('#submitButton')
//                ->assertSee('Visitante: preencha o campo corretamente.')
//                ->assertSee('Tipo de Porte: preencha o campo corretamente.')
//                ->assertSee('RG: preencha o campo corretamente.')
//                ->assertSee('Núm. Certificado: preencha o campo corretamente.')
//                ->assertSee('Validade Certificado: preencha o campo corretamente.')
//                ->assertSee('Destino: preencha o campo corretamente.')
//                ->assertSee('Plantonista: preencha o campo corretamente.')
//                ->visit('/cautions/create/' . $routine['id']);
//            $this->insertDate(0, 'started_at');
//            $this->insertDate(1, 'concluded_at');
//            $browser->pause(5000);
//            $browser->script([
//                'a = document.querySelector("[id=\'visitor_id\']");',
//                'a.value=' . $visitor['id'] . ';',
//                'a.dispatchEvent(new Event(\'input\'));',
//                'a.dispatchEvent(new Event(\'change\'));',
//            ]);
//            $browser->pause(5000);
//            $browser->script([
//                'b = document.querySelector("[id=\'certificate_type\']");',
//                'b.value=' . rand(1, 2) . ';',
//                'b.dispatchEvent(new Event(\'input\'));',
//                'b.dispatchEvent(new Event(\'change\'));',
//            ]);
//            $browser->type('#id_card', '441273312')->type('#certificate_number', '123123');
//            $browser->script([
//                'b = document.querySelector("[id=\'certificate_valid_until\']");',
//                'b.value="2024-05-05";',
//                'b.dispatchEvent(new Event(\'input\'));',
//                'b.dispatchEvent(new Event(\'change\'));',
//            ]);
//            $browser
//                ->select('#duty_user_id', $duty_user['id'])
//                ->type('#description', str_random(5))
//                ->press('#submitButton')
//                ->assertPathIs('/routines/' . $routine['id'])
//                ->assertSee('Cautela adicionada com sucesso!');
//            $caution = DB::table('cautions')
//                ->where('routine_id', '=', $routine['id'])
//                ->first();
//            $browser->visit('/cautions/' . $caution->id)->type('#description', str_random(15));
//            $this->insertDate(0, 'started_at');
//            $this->insertDate(1, 'concluded_at');
//            $browser
//                ->press('#submitButton')
//                ->assertPathIs('/routines/' . $routine['id'])
//                ->assertSee('Cautela alterada com sucesso!');
//
//            //adiciona uma arma
//
//            $browser
//                ->visit('/cautions/' . $caution->id)
//                ->press('@newWeapon')
//                ->waitForText('Nova Arma')
//                ->select('#weapon_type_id', rand(1, 3))
//                ->pause(1000);
//            $browser->script([
//                'b = document.querySelector("[dusk=\'formDescription\']");',
//                'b.value="artefato";',
//                'b.dispatchEvent(new Event(\'input\'));',
//                'b.dispatchEvent(new Event(\'change\'));',
//            ]);
//            $browser
//                ->pause(1000)
//                ->script([
//                    'b = document.querySelector("[id=\'weapon_number\']");',
//                    'b.value=' . rand(1999, 3000) . ';',
//                    'b.dispatchEvent(new Event(\'input\'));',
//                    'b.dispatchEvent(new Event(\'change\'));',
//                ]);
//            $browser
//                ->pause(1000)
//                ->select('#cabinet_id', rand(1, 2))
//                ->select('#shelf_id', rand(2, 50))
//                ->press('@submit')
//                ->pause(2000)
//                ->screenshot(6);
//        });
//    }
//
//    /**
//     * @test
//     * @group testFinishRoutine
//     * @group link
//     */


}
