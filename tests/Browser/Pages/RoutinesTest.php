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
        return Routine::orderBy('entranced_at', 'desc')->first();
    }

    public function firstRoutine()
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
                ->script("document.getElementById('entranced_at').value = '".
                    $this->lastRoutine()->entranced_at->addDay()->format('Y-m-d H:i'). "'");
            $browser
                ->screenshot('Rotina Criada')
                ->pause(1000)
                ->script('document.querySelectorAll("#submitButton")[0].click();');
            $browser
                ->assertPathIs('/routines')
                ->assertSee('Rotina adicionada com sucesso!');
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
        $this->createRoutine($this->loginAsRoot());

        // Finalizando a rotina criada
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

    // Edição de uma nova rotina (finaliza no final do teste)
    public function testEditRoutine()
    {
        $exitedAt = $this->lastRoutine()->exited_at;
        $exitedAtValue = $exitedAt ? $exitedAt->format('Y-m-d H:i') : '';

        // Chama a criação da rotina usando o usuário criado em (loginAsRoot)
        $this->createRoutine($this->loginAsRoot());

        $routine = Routine::where('status', true)->inRandomOrder()->first(); //Rotina em Aberto

        // Edita a rotina (em aberto)
        $this->browse(function ($browser) use ($routine) {
            $browser
                ->visit('/routines')
                ->assertSee('Rotinas')
                ->press('@manageRoutine-' . $routine['id'])
                ->type('#checkpoint_obs', str_random(15))
                //Editar a data para um valor aleatório
                ->script("document.getElementById('entranced_at').value = '". $this->lastRoutine()->entranced_at
                    ->setDate(2023, rand(1,12), rand(1,30))->setTime(rand(8, 20), rand (1, 59), 0). "'");
            $browser
                ->screenshot('Editou a Rotina')
                ->script('document.querySelectorAll("#submitButton")[0].click();');
            $browser
                ->assertPathIs('/routines')
                ->assertSee('Rotina alterada com sucesso!');
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

    /**
     * @test
     * @group RoutineOptions
     * @group link
     */

    public function testCreateEvents()
    {
        // Chama a criação da rotina usando o usuário criado em (loginAsRoot)
        $this->createRoutine($this->loginAsRoot());

        $routine = Routine::all()->where('status', '=>', 'true')
            ->random(1)
            ->toArray()[0];
        $event_type = EventType::all()
            ->random(6)
            ->toArray()[0];
        $sector = Sector::all()
            ->random(6)
            ->toArray()[0];
        $duty_user = User::all()
            ->random(20)
            ->toArray()[0];

        $this->browse(function ($browser) use ($routine, $event_type, $sector, $duty_user) {
            $browser
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
                // Data da ocorrência (a mesma da rotina em aberto)
                ->script("document.getElementById('occurred_at').value = '".
                    $this->lastRoutine()->entranced_at->format('Y-m-d H:i'). "'");

            $browser
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
