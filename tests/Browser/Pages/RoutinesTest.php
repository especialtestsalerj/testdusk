<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Routine;
use App\Models\EventType;
use App\Models\Sector;
use App\Models\Visitor;
use App\Support\Constants;
use Livewire\Livewire;
use App\Http\Livewire\People\People;
use App\Http\Livewire\Routines\Index;
use Illuminate\Support\Facades\DB;
use Tests\DuskTestCase;

class RoutinesTest extends DuskTestCase
{
    public function insertDate($diff, $inputId)
    {
        $this->browse(function ($browser) use ($diff, $inputId) {
            $browser->script(
                '
        var dateString = new Date().toISOString().substring(0, 16).replace("T"," ");
            if (dateString !== "") {
                var dateVal = new Date(dateString);
                var day = (' .
                    $diff .
                    '+ dateVal.getDate()).toString().padStart(2, "0");
                var month = (1 + dateVal.getMonth()).toString().padStart(2, "0");
                var hour = dateVal.getHours().toString().padStart(2, "0");
                var minute = dateVal.getMinutes().toString().padStart(2, "0");
                var sec = dateVal.getSeconds().toString().padStart(2, "0");
                var ms = dateVal.getMilliseconds().toString().padStart(3, "0");
                var inputDate = 2025 + "-" + (month) + "-" + (day) + "T" + (hour) + ":" + (minute);}
                a = document.querySelector("[id=' .
                    $inputId .
                    ']").value=(inputDate);
                dispatchEvent(new Event(\'change\'));'
            );
        });
    }

    /**
     * @test
     * @group tests_createRoutine
     * @group link
     */

    //Dusk - Criação de uma nova Rotina
    public function testCreateRoutine()
    {
        $user = User::factory()->create();
        $user->assign(Constants::ROLE_ADMINISTRATOR);
        $user->allow('*');
        $user->save();
        //dd($user->roles()->get());
        $generateRoutine = Routine::factory()
            ->create()
            ->toArray();
        //dump($generateRoutine['entranced_at']);
        $this->browse(function ($browser) use ($user, $generateRoutine) {

            $browser
                ->loginAs($user->id)
                ->visit('/routines')
                ->assertSee('Rotinas')
                ->click('#novo')
                ->assertPathIs('/routines/create')
                ->script('document.querySelectorAll("#submitButton")[0].click();');

            $browser
                ->assertSee('Turno: preencha o campo corretamente.')
                ->assertSee('Responsável (Assunção): preencha o campo corretamente.')
                ->assertSee('Carga: preencha o campo corretamente.')
                ->visit('/routines/create')
                ->pause(1000)
                ->select('#shift_id', $generateRoutine['shift_id'])
                ->assertSelected('#shift_id', $generateRoutine['shift_id'])
                ->pause(1000)
                ->type('#checkpoint_obs', $generateRoutine['checkpoint_obs'])
                ->select('#entranced_user_id', rand(2, 9))
                ->select('#exited_user_id', rand(2, 9));
            $this->insertDate(0, 'entranced_at');
            //$this->insertDate(1,'exited_at');

            $browser
                ->pause(1000)
                ->script('document.querySelectorAll("#submitButton")[0].click();');

            //$browser
                //->assertPathIs('/routines/create')
                //->waitForText('Rotina adicionada com sucesso!', 10)
                //->assertSee('Rotina finalizada com sucesso!');
        });
    }

    /**
     * @test
     * @group testEditRoutine
     * @group link
     */

    // Dusk - Edita uma Rotina

    public function testEditRoutine()
    {
        $user = User::factory()->create();
        $user->assign(Constants::ROLE_ADMINISTRATOR);
        $user->allow('*');
        $user->save();
        $routine = Routine::all()
            ->where('status', '=>', 'true')
            ->random(1)
            ->toArray()[0];

        $this->browse(function ($browser) use ($user, $routine) {
            $browser
                ->loginAs($user->id)
                ->visit('/routines')
                ->assertSee('Rotinas')
                ->press('@manageRoutine-' . $routine['id'])
                ->type('#checkpoint_obs', str_random(15));
            $this->insertDate(0, 'entranced_at');
            $browser->script('document.querySelectorAll("#submitButton")[0].click();');
            $browser->assertPathIs('/routines')->assertSee('Rotina alterada com sucesso!');
        });
    }

    /**
     * @test
     * @group testCreateEditEvent
     * @group link
     */

    // Dusk - Cria/Altera um evento detro de Rotina.

    public function testEvents()
    {
        $user = User::factory()->create();
        $user->assign(Constants::ROLE_ADMINISTRATOR);
        $user->allow('*');
        $user->save();
        $routine = Routine::all()
            ->where('status', '=>', 'true')
            ->random(1)
            ->toArray()[0];
        $event_type = EventType::all()
            ->random(1)
            ->toArray()[0];
        $sector = Sector::all()
            ->random(1)
            ->toArray()[0];
        $duty_user = User::all()
            ->random(1)
            ->toArray()[0];

        $this->browse(function ($browser) use ($user, $routine, $event_type, $sector, $duty_user) {
            $browser
                ->loginAs($user->id)
                ->visit('/routines')
                ->assertSee('Rotinas')
                ->press('@manageRoutine-' . $routine['id'])
                ->press('@newEvent')
                ->assertPathIs('/events/create/' . $routine['id'])
                ->press('#submitButton')
                ->assertSee('Tipo: preencha o campo corretamente.')
                ->assertSee('Plantonista: preencha o campo corretamente.')
                ->assertSee('Observações: preencha o campo corretamente.')
                ->visit('/events/create/' . $routine['id'])
                ->select('@event_type_id', $event_type['id']);
            $this->insertDate(0, 'occurred_at');
            $browser
                ->select('@sector_id', $sector['id'])
                ->select('@duty_user_id', $duty_user['id'])
                ->type('#description', str_random(15))
                ->press('#submitButton')
                ->assertPathIs('/routines/' . $routine['id'])
                ->assertSee('Ocorrência adicionada com sucesso!');
            $event = DB::table('events')
                ->where('routine_id', '=', $routine['id'])
                ->first();
            $browser->visit('/events/' . $event->id)->type('#description', str_random(15));
            $this->insertDate(0, 'occurred_at');
            $browser
                ->press('#submitButton')
                ->assertPathIs('/routines/' . $routine['id'])
                ->assertSee('Ocorrência alterada com sucesso!');
        });
    }

    /**
     * @test
     * @group testCreateEditVisitors
     * @group link
     */

    // Dusk - Cria/Altera um visitante detro de Rotina.

    public function testVisitors()
    {
        $user = User::factory()->create();
        $user->assign(Constants::ROLE_ADMINISTRATOR);
        $user->allow('*');
        $user->save();
        $routine = Routine::all()
            ->where('status', '=>', 'true')
            ->random(1)
            ->toArray()[0];
        $event_type = EventType::all()
            ->random(1)
            ->toArray()[0];
        $sector = Sector::all()
            ->random(1)
            ->toArray()[0];
        $duty_user = User::all()
            ->random(1)
            ->toArray()[0];

        $this->browse(function ($browser) use ($user, $routine, $event_type, $sector, $duty_user) {
            $browser
                ->loginAs($user->id)
                ->visit('/routines')
                ->assertSee('Rotinas')
                ->press('@manageRoutine-' . $routine['id'])
                ->press('@newVisitors')
                ->assertPathIs('/visitors/create/' . $routine['id'])
                ->press('#submitButton')
                ->assertSee('CPF (Visitante): preencha o campo corretamente.')
                ->assertSee('Nome (Visitante): preencha o campo corretamente.')
                ->assertSee('Plantonista: preencha o campo corretamente.')
                ->assertSee('Observações: preencha o campo corretamente.')
                ->visit('/visitors/create/' . $routine['id']);
            $this->insertDate(0, 'entranced_at');
            $this->insertDate(1, 'exited_at');
            $browser
                ->select('#sector_id', $sector['id'])
                ->select('#duty_user_id', $duty_user['id'])
                ->type('#cpf', '12312312387')
                ->click('#btn_buscar')
                ->pause(1000)
                ->type('#description', str_random(15))
                ->type('#full_name', str_random(10))
                ->type('#origin', str_random(5))
                ->press('#submitButton')
                ->assertPathIs('/routines/' . $routine['id'])
                ->assertSee('Visitante adicionado com sucesso!');
            $visitor = DB::table('visitors')
                ->where('routine_id', '=', $routine['id'])
                ->first();
            $browser->visit('/visitors/' . $visitor->id)->type('#description', str_random(15));
            $this->insertDate(0, 'entranced_at');
            $this->insertDate(1, 'exited_at');
            $browser
                ->press('#submitButton')
                ->assertPathIs('/routines/' . $routine['id'])
                ->assertSee('Visitante alterado com sucesso!');
        });
    }

    /**
     * @test
     * @group testCreateEditStuffs
     * @group link
     */

    // Dusk - Cria/Altera um materiais detro de Rotina.

    public function testStuffs()
    {
        $user = User::factory()->create();
        $user->assign(Constants::ROLE_ADMINISTRATOR);
        $user->allow('*');
        $user->save();
        $routine = Routine::all()
            ->where('status', '=>', 'true')
            ->random(1)
            ->toArray()[0];
        $event_type = EventType::all()
            ->random(1)
            ->toArray()[0];
        $sector = Sector::all()
            ->random(1)
            ->toArray()[0];
        $duty_user = User::all()
            ->random(1)
            ->toArray()[0];

        $this->browse(function ($browser) use ($user, $routine, $event_type, $sector, $duty_user) {
            $browser
                ->loginAs($user->id)
                ->visit('/routines')
                ->assertSee('Rotinas')
                ->press('@manageRoutine-' . $routine['id'])
                ->press('@newStuff')
                ->assertPathIs('/stuffs/create/' . $routine['id'])
                ->press('#submitButton')
                ->assertSee('Plantonista: preencha o campo corretamente.')
                ->assertSee('Observações: preencha o campo corretamente.')
                ->visit('/stuffs/create/' . $routine['id']);
            $this->insertDate(0, 'entranced_at');
            $this->insertDate(1, 'exited_at');
            $browser
                ->select('#sector_id', $sector['id'])
                ->select('#duty_user_id', $duty_user['id'])
                ->type('#description', str_random(5))
                ->press('#submitButton')
                ->assertPathIs('/routines/' . $routine['id'])
                ->assertSee('Material adicionado com sucesso!');
            $stuff = DB::table('stuffs')
                ->where('routine_id', '=', $routine['id'])
                ->first();
            $browser->visit('/stuffs/' . $stuff->id)->type('#description', str_random(15));
            $this->insertDate(0, 'entranced_at');
            $this->insertDate(1, 'exited_at');
            $browser
                ->press('#submitButton')
                ->assertPathIs('/routines/' . $routine['id'])
                ->assertSee('Material alterado com sucesso!');
        });
    }

    /**
     * @test
     * @group testCreateEditCautions
     * @group link
     */

    // Dusk - Cria/Altera uma Cautela de Armas detro de Rotina.

    public function testCautions()
    {
        $user = User::factory()->create();
        $user->assign(Constants::ROLE_ADMINISTRATOR);
        $user->allow('*');
        $user->save();
        $routine = Routine::all()
            ->where('status', '=>', 'true')
            ->random(1)
            ->toArray()[0];
        $event_type = EventType::all()
            ->random(1)
            ->toArray()[0];
        $sector = Sector::all()
            ->random(1)
            ->toArray()[0];
        $duty_user = User::all()
            ->random(1)
            ->toArray()[0];
        $visitor = Visitor::all()
            ->random(1)
            ->toArray()[0];

        $this->browse(function ($browser) use (
            $user,
            $routine,
            $event_type,
            $sector,
            $duty_user,
            $visitor
        ) {
            $browser
                ->loginAs($user->id)
                ->visit('/routines')
                ->assertSee('Rotinas')
                ->press('@manageRoutine-' . $routine['id'])
                ->press('@newCaution')
                ->assertPathIs('/cautions/create/' . $routine['id'])
                ->press('#submitButton')
                ->assertSee('Visitante: preencha o campo corretamente.')
                ->assertSee('Tipo de Porte: preencha o campo corretamente.')
                ->assertSee('RG: preencha o campo corretamente.')
                ->assertSee('Núm. Certificado: preencha o campo corretamente.')
                ->assertSee('Validade Certificado: preencha o campo corretamente.')
                ->assertSee('Destino: preencha o campo corretamente.')
                ->assertSee('Plantonista: preencha o campo corretamente.')
                ->visit('/cautions/create/' . $routine['id']);
            $this->insertDate(0, 'started_at');
            $this->insertDate(1, 'concluded_at');
            $browser->pause(5000);
            $browser->script([
                'a = document.querySelector("[id=\'visitor_id\']");',
                'a.value=' . $visitor['id'] . ';',
                'a.dispatchEvent(new Event(\'input\'));',
                'a.dispatchEvent(new Event(\'change\'));',
            ]);
            $browser->pause(5000);
            $browser->script([
                'b = document.querySelector("[id=\'certificate_type\']");',
                'b.value=' . rand(1, 2) . ';',
                'b.dispatchEvent(new Event(\'input\'));',
                'b.dispatchEvent(new Event(\'change\'));',
            ]);
            $browser->type('#id_card', '441273312')->type('#certificate_number', '123123');
            $browser->script([
                'b = document.querySelector("[id=\'certificate_valid_until\']");',
                'b.value="2024-05-05";',
                'b.dispatchEvent(new Event(\'input\'));',
                'b.dispatchEvent(new Event(\'change\'));',
            ]);
            $browser
                ->select('#duty_user_id', $duty_user['id'])
                ->type('#description', str_random(5))
                ->press('#submitButton')
                ->assertPathIs('/routines/' . $routine['id'])
                ->assertSee('Cautela adicionada com sucesso!');
            $caution = DB::table('cautions')
                ->where('routine_id', '=', $routine['id'])
                ->first();
            $browser->visit('/cautions/' . $caution->id)->type('#description', str_random(15));
            $this->insertDate(0, 'started_at');
            $this->insertDate(1, 'concluded_at');
            $browser
                ->press('#submitButton')
                ->assertPathIs('/routines/' . $routine['id'])
                ->assertSee('Cautela alterada com sucesso!');

            //adiciona uma arma

            $browser
                ->visit('/cautions/' . $caution->id)
                ->press('@newWeapon')
                ->waitForText('Nova Arma')
                ->select('#weapon_type_id', rand(1, 3))
                ->pause(1000);
            $browser->script([
                'b = document.querySelector("[dusk=\'formDescription\']");',
                'b.value="artefato";',
                'b.dispatchEvent(new Event(\'input\'));',
                'b.dispatchEvent(new Event(\'change\'));',
            ]);
            $browser
                ->pause(1000)
                ->script([
                    'b = document.querySelector("[id=\'weapon_number\']");',
                    'b.value=' . rand(1999, 3000) . ';',
                    'b.dispatchEvent(new Event(\'input\'));',
                    'b.dispatchEvent(new Event(\'change\'));',
                ]);
            $browser
                ->pause(1000)
                ->select('#cabinet_id', rand(1, 2))
                ->select('#shelf_id', rand(2, 50))
                ->press('@submit')
                ->pause(2000)
                ->screenshot(6);
        });
    }

    /**
     * @test
     * @group testFinishRoutine
     * @group link
     */

    // Dusk - Finalizar uma Rotina

    public function testFinishRoutine()
    {
        $user = User::factory()->create();
        $user->assign(Constants::ROLE_ADMINISTRATOR);
        $user->allow('*');
        $user->save();
        $routine = Routine::all()
            ->where('status', '=>', 'true')
            ->random(1)
            ->toArray()[0];

        $this->browse(function ($browser) use ($user, $routine) {
            $browser
                ->loginAs($user->id)
                ->visit('/routines')
                ->assertSee('Rotinas')
                ->press('@finishRoutine-' . $routine['id'])
                ->waitForText('* Campos obrigatórios');
            $this->insertDate(1, 'exited_at');
            $browser
                ->pause(1000)
                ->press('@finishRoutine')
                ->pause(1000)
                ->assertPathIs('/routines')
                ->assertSee('Rotina finalizada com sucesso!');
        });
    }
}
