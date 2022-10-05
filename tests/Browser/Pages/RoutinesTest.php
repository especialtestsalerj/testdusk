<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Sector;
use App\Support\Constants;
use Tests\DuskTestCase;

class RoutinesTest extends DuskTestCase
{
     /**
     * @test
     * @group tests_createSectors
     * @group link
     */

    //Dusk - Criação de um novo Setor
    public function tests_createSectors()
    {
        $user = User::factory()->create();

        $this->browse(function ($browser) use ($user) {
          $browser
            ->loginAs($user->id)
            ->visit('/sectors')
            ->assertSee('Nome')
            ->click('#novo')
            ->assertPathIs('/sectors/create')
            ->type('#name',$user->name)
            ->assertChecked('@checkboxSectors')
            ->script('document.querySelectorAll("#submitButton")[0].click();');
          $browser
            ->assertPathIs('/sectors')
            ->assertSee('Setor criado com sucesso!');
        });
    }

     /**
     * @test
     * @group testSearch
     * @group link
     */

     // Dusk - Procura um setor
     public function testSearch()
    {
        $user = User::factory()->create();
        $sector = Sector::all()->random(1)->toArray()[0];

        //Wrong Search
        $this->browse(function ($browser) use ($user) {
            $browser
              ->loginAs($user->id)
                ->visit('/sectors')
                ->type('@search-input', '132312312vcxvdsf413543445654')
                ->click('@search-button')
                ->waitForText('Nenhum Setor encontrado',8)
                ->assertSee('Nenhum Setor encontrado');
        });

        //Right Search
        $this->browse(function ($browser) use ($user,$sector) {
          $browser
            ->loginAs($user->id)
              ->visit('/sectors')
              ->type('@search-input', $sector['name'])
              ->click('@search-button')
              ->assertSee($sector['id']);
      });
    }
}
