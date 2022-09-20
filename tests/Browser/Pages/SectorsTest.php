<?php

namespace Tests\Feature;

use Tests\DuskTestCase;

class SectorsTest extends DuskTestCase
{   
     /**
     * @test
     * @group tests_sectors
     * @group link
     */

    //Dusk - Setores
    public function tests_sectors()
    {
        $user = User::factory()->create();
        $user->assign(Constants::ROLE_ADMINISTRATOR);
    
        $this->browse(function ($browser) use ($user) {
          $browser
            ->loginAs($user->id)
            ->visit('/sectors/create')
            ->assertSee('Nome');
        });
        
    }
}
