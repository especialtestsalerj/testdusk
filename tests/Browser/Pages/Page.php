<?php

namespace Tests\Browser\Pages;

use App\Models\Routine;
use App\Models\User;
use App\Support\Constants;

trait Page
{
    /**
     * Cria um usuário administrador.
     *
     * @return User O usuário administrador criado
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
     * @return Routine A última rotina adicionada
     */
    public function getDateRoutine(): ?Routine
    {
        return Routine::orderByDesc('entranced_at')->first();
    }

    /**
     * Cria uma nova rotina.
     *
     * @return void
     */
    public function createRoutine(): void
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
                    $this->getDateRoutine()->entranced_at->addDay()->format('Y-m-d H:i') . "'");

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
    public function finishOpenRoutine(): void
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
}
