<?php

namespace Tests\Browser\Pages;

use App\Models\Routine;
use App\Models\User;
use App\Support\Constants;

trait Page
{
    /**
     * Get the global element shortcuts for the site.
     *
     * @return array<string, string>
     */
    public static function siteElements(): array
    {
        return [
            '@novo' => '#novo',
        ];
    }

    public function createAdminUser()
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


    public function createRoutine()
    {
        $generateRoutine = Routine::factory()->raw();

        $user = $this->createAdminUser();

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
                ->select('#shift_id', $generateRoutine['shift_id'])
                ->assertSelected('#shift_id', $generateRoutine['shift_id'])
                ->type('#checkpoint_obs', $generateRoutine['checkpoint_obs'])
                ->select('#entranced_user_id', rand(2, 15))
                ->select('#exited_user_id', rand(2, 15))
                ->waitFor('#entranced_at')
                ->script("document.getElementById('entranced_at').value = '".
                    $this->lastRoutine()->entranced_at->addDay()->format('Y-m-d H:i'). "'");
            $browser
                ->script('document.querySelectorAll("#submitButton")[0].click();');
            $browser
                ->assertPathIs('/routines')
                ->assertSee('Rotina adicionada com sucesso!');

            // Permanece logado para a utilização nos testes
        });
    }
    public function finishOpenRoutine()
    {
        $routine = Routine::where('status', true)->inRandomOrder()->first();
        $exitedAtValue = $routine->entranced_at->format('Y-m-d H:i');

        // Finalizando a rotina editada
        $this->browse(function ($browser) use ($routine, $exitedAtValue) {
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
