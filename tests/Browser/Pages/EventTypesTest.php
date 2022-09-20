<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\EventType;
use Illuminate\Support\Facades\DB;
use App\Support\Constants;
use Tests\DuskTestCase;

class EventTypesTest extends DuskTestCase
{   
     /*
     * @test
     * @group tests_createEventTypes
     * @group link
     */

    //Dusk - Criação de um novo tipo de ocorrencia.
    public function tests_createSectors()
    {
        $user = User::factory()->create();
        $generateSector = EventType::factory()->create()->toArray();
    
        $this->browse(function ($browser) use ($user,$generateSector) {
          $browser
            ->loginAs($user->id)
            ->visit('/sectors')
            ->assertSee('Nome')
            ->click('#novo')
            ->assertPathIs('/sectors/create')
            ->type('#name', $generateSector['name'])
            ->assertChecked('@checkboxSectors')
            ->script('document.querySelectorAll("#submitButton")[0].click();');
          $browser
            ->assertPathIs('/sectors')
            ->assertSee('Setor criado com sucesso!');
        });
        $this->assertDatabaseHas('sectors', [
          'name' => $generateSector['name']
      ]);
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

    /*
     * @test
     * @group tests_editSectors
     * @group link
     */

    //Dusk - Edição de um novo Setor
    public function tests_editSectors()
    {
        $user = User::factory()->create();
        $randomSector = DB::table('sectors')
        ->inRandomOrder()
        ->first();
    
        $this->browse(function ($browser) use ($user,$randomSector) {
          $browser
            ->loginAs($user->id)
            ->visit('/sectors')
            ->type('@search-input', $randomSector->name)
            ->click('@search-button')
            ->assertSee($randomSector->id)
            ->press('@sector-'.$randomSector->id)
            ->type('#name','**'.$randomSector->name.'**')
            ->checked('@checkboxSectors')
            ->assertChecked('@checkboxSectors')
            ->script('document.querySelectorAll("#submitButton")[0].click();');
          $browser
            ->assertPathIs('/sectors')
            ->assertSee('Setor alterado com sucesso!');
        });
        $this->assertDatabaseHas('sectors', [
          'name' =>'**'.$randomSector->name.'**',
      ]);
    }
}
