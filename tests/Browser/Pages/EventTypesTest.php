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
        $generateEventType = EventType::factory()->create()->toArray();
    
        $this->browse(function ($browser) use ($user,$generateEventType) {
          $browser
            ->loginAs($user->id)
            ->visit('/event_types')
            ->assertSee('Nome')
            ->click('#novo')
            ->assertPathIs('/event_types/create')
            ->type('#name', $generateEventType['name'])
            ->assertChecked('@checkboxEventTypes')
            ->script('document.querySelectorAll("#submitButton")[0].click();');
          $browser
            ->assertPathIs('/event_types')
            ->assertSee('Tipo de ocorrência adicionada com sucesso!');
        });
        $this->assertDatabaseHas('event_types', [
          'name' => $generateEventType['name']
      ]);
    }

     /**
     * @test
     * @group testSearch
     * @group link
     */
    
     // Dusk - Procura um tipo de ocorrencia
     public function testSearch()
    { 
        $user = User::factory()->create();
        $event_type = EventType::all()->random(1)->toArray()[0];

        //Wrong Search
        $this->browse(function ($browser) use ($user) {
            $browser
              ->loginAs($user->id)
                ->visit('/event_types')
                ->type('@search-input', '132312312vcxvdsf413543445654')
                ->click('@search-button')
                ->waitForText('Nenhum Tipo de Ocorrência encontrado',8)
                ->assertSee('Nenhum Tipo de Ocorrência encontrado');
        });
        
        //Right Search
        $this->browse(function ($browser) use ($user,$event_type) {
          $browser
            ->loginAs($user->id)
              ->visit('/event_types')
              ->type('@search-input', $event_type['name'])
              ->click('@search-button')
              ->assertSee($event_type['id']);
      });
    }

    /*
     * @test
     * @group tests_editEventTypes
     * @group link
     */

    //Dusk - Edição de um novo tipo de ocorrencia
    public function tests_editSectors()
    {
        $user = User::factory()->create();
        $randomEventType = DB::table('event_types')
        ->inRandomOrder()
        ->first();
    
        $this->browse(function ($browser) use ($user,$randomEventType) {
          $browser
            ->loginAs($user->id)
            ->visit('/event_types')
            ->type('@search-input', $randomEventType->name)
            ->click('@search-button')
            ->assertSee($randomEventType->id)
            ->press('@event_type-'.$randomEventType->id)
            ->type('#name','**'.$randomEventType->name.'**')
            ->checked('@checkboxSectors')
            ->assertChecked('@checkboxSectors')
            ->script('document.querySelectorAll("#submitButton")[0].click();');
          $browser
            ->assertPathIs('/sectors')
            ->assertSee('Tipo de ocorrência alterado com sucesso!');
        });
        $this->assertDatabaseHas('event_types', [
          'name' =>'**'.$randomEventType->name.'**',
      ]);
    }
}
