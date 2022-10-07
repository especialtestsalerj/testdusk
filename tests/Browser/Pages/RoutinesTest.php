<?php

namespace Tests\Feature;

use App\Models\User;
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
        $generateSector = ['name'=>strtoupper(faker()->unique()->company)];

        $this->browse(function ($browser) use ($user,$generateSector) {
          $browser
            ->loginAs($user->id)
            ->visit('/sectors')
            ->assertSee('Nome')
            ->click('#novo')
            ->assertPathIs('/sectors/create')
            ->script('document.querySelectorAll("#submitButton")[0].click();');
          $browser
            ->assertSee('Nome: preencha o campo corretamente.')
            ->type('#name', $generateSector['name'])
            ->assertChecked('@checkboxSectors')
            ->script('document.querySelectorAll("#submitButton")[0].click();');
          $browser
            ->assertPathIs('/sectors')
            ->assertSee('Setor adicionado com sucesso!');
        });
    }
}
