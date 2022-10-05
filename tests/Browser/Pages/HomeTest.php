<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Sector;
use Illuminate\Support\Facades\DB;
use App\Support\Constants;
use Tests\DuskTestCase;

class HomeTest extends DuskTestCase
{
    /**
     * @test
     * @group tests_makesMeOwner
     * @group link
     */

    public function makesMeOwner(){
        
        $user =  DB::table('users')
            ->where('username','=','rcstuckert')
            ->first();
        $user->assign(Constants::ROLE_ADMINISTRATOR);
        $user->allow('*');
        $user->save();

        
        $this->browse(function ($browser) use ($user,$generateSector) {
            $browser
              ->loginAs($user->id)
              ->visit('/sectors');
            });
        }
}
