<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Routine;
use App\Support\Constants;
use Tests\DuskTestCase;


class RoutinesTest extends DuskTestCase
{
    /**
     * @test
     * @group tests_createRoutine
     * @group link
     */

    //Dusk - Criação de uma nova Rotina
    public function tests_createRoutine()
    {
        $user = User::factory()->create();
        $user->assign(Constants::ROLE_ADMINISTRATOR);
        $user->allow('*');
        $user->save();
        //dd($user->roles()->get());
        $generateRoutine = Routine::factory()->create()->toArray();

        $this->browse(function ($browser) use ($user,$generateRoutine) {
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
            ->select('#shift_id',$generateRoutine['shift_id'])
            ->type('#checkpoint_obs', $generateRoutine['checkpoint_obs'])
            ->select('#entranced_user_id', $generateRoutine['entranced_user_id'])
            ->select('#exited_user_id', $generateRoutine['exited_user_id'])
            ->script('document.querySelectorAll("#submitButton")[0].click();');
          $browser
            ->assertPathIs('/routines')
            ->assertSee(' Rotina adicionada com sucesso!');
        });
    }
}
