<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\EventType;
use Illuminate\Support\Facades\DB;
use App\Http\Livewire\EventTypes\Index;
use App\Support\Constants;
use Livewire\Livewire;
use Tests\DuskTestCase;

class EventTypesTest extends DuskTestCase
{
    /**
     * @test
     * @group tests_createEventTypes
     * @group link
     */

    //Dusk - Criação de um novo Tipo de Ocorrência
    public function tests_createEventTypes()
    {
        $user = User::factory()->create();
        $user->assign(Constants::ROLE_ADMINISTRATOR);
        $user->allow('*');
        $user->save();
        //dd($user->roles()->get());
        $generateEventType = ['name' => strtoupper(faker()->unique()->company)];

        $this->browse(function ($browser) use ($user, $generateEventType) {
            $browser
                ->loginAs($user->id)
                ->visit('/event-types')
                ->assertSee('Nome')
                ->click('#novo')
                ->assertPathIs('/event-types/create')
                ->script('document.querySelectorAll("#submitButton")[0].click();');
            $browser
                ->assertSee('Nome: preencha o campo corretamente.')
                ->type('#name', $generateEventType['name'])
                ->assertChecked('@checkboxEventTypes')
                ->script('document.querySelectorAll("#submitButton")[0].click();');
            $browser
                ->assertPathIs('/event-types')
                ->assertSee('Tipo de Ocorrência adicionado com sucesso!');
        });
    }

    /**
     * @test
     * @group testSearchEventTypes
     * @group link
     */

    // Livewire - Procura um Tipo de Ocorrência
    public function testSearchEventTypes()
    {
        $user = User::factory()->create();
        $user->assign(Constants::ROLE_ADMINISTRATOR);
        $user->allow('*');
        $user->save();
        $event_type = EventType::all()
            ->random(1)
            ->toArray()[0];

        Livewire::test(Index::class)
            ->assertSee('Tipos de Ocorrência')
            ->set('searchString', $event_type['name'])
            ->assertSet('searchString', $event_type['name'])
            ->assertSee($event_type['id'])
            ->set('searchString', '6662223')
            ->assertSee('Nenhum Tipo de Ocorrência encontrado.');
    }

    /*
     * @test
     * @group tests_editEventTypes
     * @group link
     */

    //Dusk e Livewire - Edição de um novo Tipo de Ocorrência
    public function tests_editEventTypes()
    {
        $user = User::factory()->create();
        $user->assign(Constants::ROLE_ADMINISTRATOR);
        $user->allow('*');
        $user->save();
        $randomEventType = DB::table('event_types')
            ->inRandomOrder()
            ->first();

        $this->browse(function ($browser) use ($user, $randomEventType) {
            $browser
                ->loginAs($user->id)
                ->visit('event-types/' . $randomEventType->id)
                ->type('#name', '**' . $randomEventType->name . '**')
                ->check('@checkboxEventTypes')
                ->assertChecked('@checkboxEventTypes')
                ->script('document.querySelectorAll("#submitButton")[0].click();');
            $browser
                ->assertPathIs('/event-types')
                ->assertSee('Tipo de Ocorrência alterado com sucesso!');
        });
        $this->assertDatabaseHas('event_types', ['name' => '**' . $randomEventType->name . '**']);

        Livewire::test(Index::class)
            ->assertSee('Tipos de Ocorrência')
            ->set('searchString', $randomEventType->name)
            ->assertSet('searchString', $randomEventType->name)
            ->assertSee($randomEventType->id);
    }
}
