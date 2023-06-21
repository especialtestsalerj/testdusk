<?php

namespace Tests\Browser\Pages;

use App\Models\Routine;
use App\Models\Sector;
use App\Models\User;
use App\Support\Constants;
use Faker\Factory as Faker;

trait Page
{
    /**
     * Cria um usuário administrador.
     *
     * @return user
     */
    public function createAdminUser(): User
    {
        $adminUser = User::factory()->create();
        $adminUser->assign(Constants::ROLE_ADMINISTRATOR)->allow('*')->save();

        return $adminUser;
    }

    /**
     * Retorna a data da última rotina adicionada.
     *
     * @return 'entranced_at'
     */
    public function getDataRotina(): ?Routine
    {
        return Routine::orderByDesc('entranced_at')->first();
    }

    /**
     * Cria uma nova rotina.
     *
     * @return void
     */
    public function criaRotina(): void
    {
        $generateRoutine = Routine::factory()->raw();

        $adminUser = $this->createAdminUser();

        $this->browse(function ($browser) use ($adminUser, $generateRoutine) {
            $browser
                ->loginAs($adminUser->id)
                ->visit('/routines')
                ->assertSee('Rotinas')
                ->click('#novo')
                ->assertPathIs('/routines/create')
                ->script('document.querySelectorAll("#submitButton")[0].click();');

            $browser
                ->assertSee('Turno: preencha o campo corretamente.')
                ->assertSee('Responsável (Assunção): preencha o campo corretamente.')
                ->assertSee('Carga: preencha o campo corretamente.')
                ->visit('routines/create')
                ->select('#shift_id', $generateRoutine['shift_id'])
                ->assertSelected('#shift_id', $generateRoutine['shift_id'])
                ->type('#checkpoint_obs', $generateRoutine['checkpoint_obs'])
                ->select('#entranced_user_id', rand(2, 15))
                ->select('#exited_user_id', rand(2, 15))
                ->waitFor('#entranced_at')
                ->script("document.getElementById('entranced_at').value = '" .
                    $this->getDataRotina()->entranced_at->addDay()->format('Y-m-d H:i') . "'");

            $browser->script('document.querySelectorAll("#submitButton")[0].click();');

            $browser
                ->assertPathIs('/routines')
                ->assertSee('Rotina adicionada com sucesso!');

            // Permanece logado para a utilização nos testes
        });
    }

    /**
     * Finaliza uma rotina em aberto.
     *
     * @return void
     */
    public function finalizaRotinaAberta(): void
    {
        $openRoutine = Routine::where('status', true)->inRandomOrder()->first();
        $exitedAtValue = $openRoutine->entranced_at->format('Y-m-d H:i');

        // Finalizando a rotina em aberto
        $this->browse(function ($browser) use ($openRoutine, $exitedAtValue) {
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
                ->assertSee('Rotina finalizada com sucesso!');
        });
    }

    public function createVistante()
    {
        $routine = Routine::where('status', true)->inRandomOrder()->first(); // Rotina em aberto
        $entranced_at = $routine->entranced_at->format('Y-m-d H:i'); // Pega a data da rotina em aberto

        $sector = Sector::all()->random(6)->toArray()[0];
        $duty_user = User::all()->random(20)->toArray()[0];

        $this->browse(function ($browser) use ($entranced_at, $routine, $sector, $duty_user) {
            $browser
                ->visit('/routines')
                ->assertSee('Rotinas')
                ->screenshot('criou a rotina - visitante')
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
                ->press('#submitButton')
                ->assertPathIs('/routines/' . $routine['id'])
                ->assertSee('Visitante adicionado/a com sucesso!')
                ->screenshot('Visitante preenchido');

        });
    }
}
