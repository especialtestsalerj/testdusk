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

class RoutinesTest extends DuskTestCase
{
    use Page;

    public function loginAsRoot()
    {
        $user = User::factory()->create();
        $user->assign(Constants::ROLE_ADMINISTRATOR);
        $user->allow('*');
        $user->save();
        return $user; // retorna o usuário criado
    }

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

    public function lastRoutine()
    {
        return Routine::orderBy('entranced_at', 'desc')->first();
    }


    public function createRoutine($user)
    {
        $generateRoutine = Routine::factory()->raw();

        $this->browse(function ($browser) use ($user, $generateRoutine) {
            $browser
                ->loginAs($user->id)
                ->visit('/routines')
                ->assertSee('Rotinas')
                ->click(Page::siteElements()['@novo'])
                ->assertPathIs('/routines/create')
                ->script('document.querySelectorAll("#submitButton")[0].click();');
            $browser
                ->assertSee('Turno: preencha o campo corretamente.')
                ->assertSee('Responsável (Assunção): preencha o campo corretamente.')
                ->assertSee('Carga: preencha o campo corretamente.')
                ->visit('routines/create')
                ->pause(1000)
                ->select('#shift_id', $generateRoutine['shift_id'])
                ->assertSelected('#shift_id', $generateRoutine['shift_id'])
                ->pause(1000)
                ->type('#checkpoint_obs', $generateRoutine['checkpoint_obs'])
                ->select('#entranced_user_id', rand(2, 15))
                ->select('#exited_user_id', rand(2, 15))
                ->waitFor('#entranced_at')
                ->script("document.getElementById('entranced_at').value = '".
                    $this->lastRoutine()->entranced_at->addDay()->format('Y-m-d H:i'). "'");
            $browser
                ->screenshot('Rotina Criada')
                ->pause(1000)
                ->script('document.querySelectorAll("#submitButton")[0].click();');
            $browser
                ->assertPathIs('/routines')
                ->assertSee('Rotina adicionada com sucesso!')
                ->logout();
        });
    }

    /**
     * @test
     * @group CreateRoutine
     * @group link
     */

    // Cria e finaliza uma nova rotina
    public function testCreateRoutine()
    {
        $exitedAt = $this->lastRoutine()->exited_at;
        $exitedAtValue = $exitedAt ? $exitedAt->format('Y-m-d H:i') : '';

        // Chama a criação da rotina usando o usuário criado em (loginAsRoot)
        $user = $this->loginAsRoot();
        $this->createRoutine($user);

        // Finalizando a rotina criada
        $this->browse(function ($browser) use ($exitedAtValue, $user) {
            $browser
                ->loginAs($user)
                ->visit('/routines')
                ->assertSee('Rotinas')
                ->press('@finishRoutine')
                ->waitForText('* Campos obrigatórios')
                ->script("document.getElementById('exited_at').value = '{$exitedAtValue}'");
            $browser
                ->pause(1000)
                ->click('@finishRoutine', ['force' => true])
                ->assertPathIs('/routines')
                ->assertSee('Rotina finalizada com sucesso!')
                ->screenshot('Rotina Finalizada')
                ->logout();
        });
    }

    // Edição de uma nova rotina (finaliza no final do teste)
    public function testEditRoutine()
    {
        $exitedAt = $this->lastRoutine()->exited_at;
        $exitedAtValue = $exitedAt ? $exitedAt->format('Y-m-d H:i') : '';

        // Chama a criação da rotina usando o usuário criado em (loginAsRoot)
        $user = $this->loginAsRoot();
        $this->createRoutine($user);

        $routine = Routine::where('status', true)->inRandomOrder()->first(); // Rotina em aberto

        // Edita a rotina (em aberto)
        $this->browse(function ($browser) use ($routine, $user, $exitedAtValue) {
            $browser
                ->loginAs($user)
                ->visit('/routines')
                ->assertSee('Rotinas')
                ->press('@manageRoutine-' . $routine['id'])
                ->type('#checkpoint_obs', str_random(15))
                ->script("document.getElementById('entranced_at').value = '". $this->lastRoutine()->entranced_at
                        ->setDate(2023, rand(1,12), rand(1,30))->setTime(rand(8, 20), rand (1, 59), 0). "'");
            $browser
                ->screenshot('Editou a Rotina')
                ->script('document.querySelectorAll("#submitButton")[0].click();');
            $browser
                ->assertPathIs('/routines')
                ->assertSee('Rotina alterada com sucesso!');

        // Finalizando a rotina editada

            $browser
                ->visit('/routines')
                ->assertSee('Rotinas')
                ->press('@finishRoutine')
                ->waitForText('* Campos obrigatórios')
                ->script("document.getElementById('exited_at').value = '{$exitedAtValue}'");
            $browser
                ->pause(1000)
                ->click('@finishRoutine', ['force' => true])
                ->assertPathIs('/routines')
                ->assertSee('Rotina finalizada com sucesso!')
                ->screenshot('Rotina Finalizada')
                ->logout();

        });
    }



    /**
     * @test
     * @group RoutineOptions
     * @group link
     */

    public function testCreateEvents()
    {
        // Chama a criação da rotina usando o usuário criado em (loginAsRoot)
        $user = $this->loginAsRoot();
        $this->createRoutine($user);

        $routine = Routine::where('status', true)->inRandomOrder()->first(); // Rotina em Aberto
        $exitedAtValue = $routine->entranced_at->format('Y-m-d H:i');

        $event_type = EventType::all()
            ->random(6)
            ->toArray()[0];
        $sector = Sector::all()
            ->random(6)
            ->toArray()[0];
        $duty_user = User::all()
            ->random(20)
            ->toArray()[0];

        $this->browse(function ($browser) use ($user, $routine, $event_type, $sector, $duty_user, $exitedAtValue) {
            $browser
                ->loginAs($user)
                ->visit('/routines')
                ->assertSee('Rotinas')
                ->press('@manageRoutine-' . $routine['id'])
                ->press('@newEvent')
                ->assertPathIs('/routines' . '/' . $routine['id'] . '/events/create')
                ->press('#submitButton')
                ->assertSee('Tipo: preencha o campo corretamente.')
                ->assertSee('Plantonista: preencha o campo corretamente.')
                ->assertSee('Observações: preencha o campo corretamente.')
                ->script("document.getElementById('occurred_at').value = '{$exitedAtValue}'");

            $browser
                ->select('#event_type_id', $event_type['id'])
                ->select('#sector_id', $sector['id'])
                ->select('#duty_user_id', $duty_user['id'])
                ->type('#description', str_random(15))
                ->press('#submitButton')
                ->assertPathIs('/routines/' . $routine['id'])
                ->assertSee('Ocorrência adicionada com sucesso!');
        });

        // Finalizando a rotina editada
        $this->browse(function ($browser) use ($exitedAtValue) {
            $browser
                ->visit('/routines')
                ->assertSee('Rotinas')
                ->press('@finishRoutine')
                ->waitForText('* Campos obrigatórios')
                ->script("document.getElementById('exited_at').value = '{$exitedAtValue}'");
            $browser
                ->pause(1000)
                ->click('@finishRoutine', ['force' => true])
                ->assertPathIs('/routines')
                ->assertSee('Rotina finalizada com sucesso!')
                ->screenshot('Rotina Finalizada')
                ->logout();
        });

    }
//    public function testVisitors()
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
//
//        $this->browse(function ($browser) use ($user, $routine, $event_type, $sector, $duty_user) {
//            $browser
//                ->loginAs($user->id)
//                ->visit('/routines')
//                ->assertSee('Rotinas')
//                ->press('@manageRoutine-' . $routine['id'])
//                ->script('document.getElementById("newVisitor").click()');
//            $browser
//                ->assertPathIs('/routines'. '/' . $routine['id'] . '/visitors/create' )
//
//                ->press('#submitButton')
//                ->assertSee('CPF (Visitante): preencha o campo corretamente.')
//                ->assertSee('Nome (Visitante): preencha o campo corretamente.')
//                ->assertSee('Plantonista: preencha o campo corretamente.')
//                ->assertSee('Observações: preencha o campo corretamente.');
//            $this->insertDate(1, 'exited_at');
//            $browser
//                ->select('#sector_id', $sector['id'])
//                ->select('#duty_user_id', $duty_user['id'])
//                ->type('#cpf', '12312312387')
//                ->click('#btn_buscar')
//                ->pause(1000)
//                ->type('#description', str_random(15))
//                ->type('#full_name', str_random(10))
//                ->type('#origin', str_random(5))
//                ->press('#submitButton')
//                ->assertPathIs('/routines/' . $routine['id'])
//                ->assertSee('Visitante adicionado/a com sucesso!');
//        });
//    }
//
//    /**
//     * @test
//     * @group testCreateEditStuffs
//     * @group link
//     */
//
//    // Dusk - Cria/Altera um materiais detro de Rotina.
//
//    public function testStuffs()
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
//
//        $this->browse(function ($browser) use ($user, $routine, $event_type, $sector, $duty_user) {
//            $browser
//                ->loginAs($user->id)
//                ->visit('/routines')
//                ->assertSee('Rotinas')
//                ->press('@manageRoutine-' . $routine['id'])
//                ->script('document.getElementById("newStuff").click()');
//
//            $browser
//                ->assertPathIs('/routines'. '/' . $routine['id'] . '/stuffs/create')
//                ->screenshot('stuffs')
//                ->press('#submitButton')
//                ->assertSee('Plantonista: preencha o campo corretamente.')
//                ->assertSee('Observações: preencha o campo corretamente.');
//            $this->insertDate(1, 'exited_at');
//            $browser
//                ->select('#sector_id', $sector['id'])
//                ->select('#duty_user_id', $duty_user['id'])
//                ->type('#description', str_random(5))
//                ->press('#submitButton')
//                ->assertPathIs('/routines/' . $routine['id'])
//                ->assertSee('Material adicionado com sucesso!');
//            // $stuff = DB::table('stuffs')
//            //     ->where('routine_id', '=', $routine['id'])
//            //     ->first();
//            // $browser->visit('/stuffs/' . $stuff->id)->type('#description', str_random(15));
//            // $this->insertDate(0, 'entranced_at');
//            // $this->insertDate(1, 'exited_at');
//            // $browser
//            //     ->press('#submitButton')
//            //     ->assertPathIs('/routines/' . $routine['id'])
//            //     ->assertSee('Material alterado com sucesso!');
//        });
//    }
//
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
