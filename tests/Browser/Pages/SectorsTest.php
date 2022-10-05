<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Sector;
use Illuminate\Support\Facades\DB;
use App\Support\Constants;
use Tests\DuskTestCase;

class SectorsTest extends DuskTestCase
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
        $this->assertDatabaseHas('sectors', [
0      ]);
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
      $user->assign(Constants::ROLE_ADMINISTRATOR);
      $user->allow('*');
      $user->save();
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

    /*
     * @test
     * @group tests_editSectors
     * @group link
     */

    //Dusk - Edição de um novo Setor
    public function tests_editSectors()
    {
      $user = User::factory()->create();
      $user->assign(Constants::ROLE_ADMINISTRATOR);
      $user->allow('*');
      $user->save();
        $randomSector = DB::table('sectors')
        ->inRandomOrder()
        ->first();

        $this->browse(function ($browser) use ($user,$randomSector) {
          $browser
            ->loginAs($user->id)
            ->visit('/sectors')
            ->screenshot('1')
            ->type('@search-input', $randomSector->name)
            ->click('@search-button')
            ->screenshot('2')
            ->assertSee($randomSector->id)
            ->press('@sector-'.$randomSector->id)
            ->type('#name','**'.$randomSector->name.'**')
            ->screenshot('3')
            ->check('@checkboxSectors')
            ->assertChecked('@checkboxSectors')
            ->screenshot('4')
            ->script('document.querySelectorAll("#submitButton")[0].click();');
          $browser
            ->screenshot('6')
            ->assertPathIs('/sectors')
            ->assertSee('Setor alterado com sucesso!')
            ->type('@search-input', $randomSector->name)
            ->click('@search-button')
            ->screenshot('7')
            ->assertSee($randomSector->id);
        });
        $this->assertDatabaseHas('sectors', ['name' =>'**'.$randomSector->name.'**']);
    }
}
