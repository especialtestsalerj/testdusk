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

    public function lastRoutine()
    {
        return Routine::latest()->first();
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
                ->script("document.getElementById('entranced_at').value = '".$this->lastRoutine()->entranced_at->addDay()->format('Y-m-d H:i'). "'");


            $browser->screenshot('inseriu')->pause(1000)->script('document.querySelectorAll("#submitButton")[0].click();');
            $browser->assertPathIs('/routines')->assertSee('Rotina adicionada com sucesso!');
        });
    }

    /**
     * @test
     * @group CreateRoutine
     * @group link
     */

    //Dusk - Criação de uma nova Rotina

    public function testRoutine()
    {
        // faz o login do usuário

        $this->createRoutine($this->loginAsRoot());
            $routine = Routine::where('status', true)->inRandomOrder()->first();

            // Edita uma Rotina
            $this->browse(function ($browser) use ($routine) {
                $browser
                    ->visit('/routines')
                    ->assertSee('Rotinas')
                    ->press('@manageRoutine-' . $routine['id'])
                    ->type('#checkpoint_obs', str_random(15))
                    ->select('#entranced_at', $this->lastRoutine()->entranced_at->setTime(10, 30, 0));

                $browser->script('document.querySelectorAll("#submitButton")[0].click();');
                $browser->assertPathIs('/routines')->assertSee('Rotina alterada com sucesso!')
                ->logout();
            });
    }

    /**
     * @test
     * @group Ocorrencia
     * @group link
     */

    public function testEvents()
    {
        $user = $this->loginAsRoot(); // faz o login do usuário

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
                ->screenshot('teste')
                ->assertSee('Rotinas')
                ->press('@manageRoutine-' . $routine['id'])
                ->press('@newEvent')
                ->assertPathIs('/routines' . '/' . $routine['id'] . '/events/create')
                ->press('#submitButton')
                ->assertSee('Tipo: preencha o campo corretamente.')
                ->assertSee('Plantonista: preencha o campo corretamente.')
                ->assertSee('Observações: preencha o campo corretamente.')
                ->select('#event_type_id', $event_type['id'])
                ->select('#sector_id', $sector['id'])
                ->select('#duty_user_id', $duty_user['id'])
                ->type('#description', str_random(15))
                ->press('#submitButton')
                ->assertPathIs('/routines/' . $routine['id'])
                ->assertSee('Ocorrência adicionada com sucesso!');

        });
    }



}
