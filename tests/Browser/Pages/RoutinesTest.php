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
        dump($generateRoutine['entranced_at'][8]);
        $this->browse(function ($browser) use ($user,$generateRoutine) {
          $browser
            ->loginAs($user->id)
            ->visit('/routines')
            ->assertSee('Rotinas')
            ->click('#novo')
            ->assertPathIs('/routines/create')
            ->screenshot('1')
            ->script('document.querySelectorAll("#submitButton")[0].click();');
          $browser
            ->assertSee('Turno: preencha o campo corretamente.')
            ->assertSee('Responsável (Assunção): preencha o campo corretamente.')
            ->assertSee('Carga: preencha o campo corretamente.')
            ->visit('/routines/create')
            ->assertPathIs('/routines/create')
            ->pause(1000)
            ->screenshot('1')
            ->select('#shift_id',$generateRoutine['shift_id'])
            ->assertSelected('#shift_id',$generateRoutine['shift_id'])
            ->type('#entranced_at',str_replace($generateRoutine['entranced_at']))
            ->screenshot('2');
            //->script('entranced_at.value="2022-10-20 08:09";');
          $browser
            ->type('#checkpoint_obs', $generateRoutine['checkpoint_obs'])
            ->select('#entranced_user_id', rand(2,9))
            ->select('#exited_user_id', rand(2,9))
            ->script('document.querySelectorAll("#submitButton")[0].click();');
          $browser
            ->assertPathIs('/routines')
            ->assertSee(' Rotina adicionada com sucesso!');
        });
    }
}
