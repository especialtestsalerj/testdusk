<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Sector;
use Illuminate\Support\Facades\DB;
use App\Http\Livewire\Sectors\Index;
use App\Support\Constants;
use Livewire\Livewire;
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
        $generateSector = ['name' => strtoupper(faker()->unique()->company)];

        $this->browse(function ($browser) use ($user, $generateSector) {
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
            $browser->assertPathIs('/sectors')->assertSee('Setor adicionado com sucesso!');
        });
    }

    /**
     * @test
     * @group testSearch
     * @group link
     */

    // Livewire - Procura um setor
    public function testSearch()
    {
        $user = User::factory()->create();
        $user->assign(Constants::ROLE_ADMINISTRATOR);
        $user->allow('*');
        $user->save();
        $sector = Sector::all()
            ->random(1)
            ->toArray()[0];

        Livewire::test(Index::class)
            ->assertSee('Setores')
            ->set('searchString', $sector['name'])
            ->assertSet('searchString', $sector['name'])
            ->assertSee($sector['id'])
            ->set('searchString', '6662223')
            ->assertSee('Nenhum Setor encontrado.');
    }

    /*
     * @test
     * @group tests_editSectors
     * @group link
     */

    //Dusk e Livewire - Edição de um novo Setor
    public function tests_editSectors()
    {
        $user = User::factory()->create();
        $user->assign(Constants::ROLE_ADMINISTRATOR);
        $user->allow('*');
        $user->save();
        $randomSector = DB::table('sectors')
            ->inRandomOrder()
            ->first();

        $this->browse(function ($browser) use ($user, $randomSector) {
            $browser
                ->loginAs($user->id)
                ->visit('/sectors/' . $randomSector->id)
                ->type('#name', '**' . $randomSector->name . '**')
                ->check('@checkboxSectors')
                ->assertChecked('@checkboxSectors')
                ->script('document.querySelectorAll("#submitButton")[0].click();');
            $browser->assertPathIs('/sectors')->assertSee('Setor alterado com sucesso!');
        });
        $this->assertDatabaseHas('sectors', ['name' => '**' . $randomSector->name . '**']);

        Livewire::test(Index::class)
            ->assertSee('Setores')
            ->set('searchString', $randomSector->name)
            ->assertSet('searchString', $randomSector->name)
            ->assertSee($randomSector->id);
    }
}
