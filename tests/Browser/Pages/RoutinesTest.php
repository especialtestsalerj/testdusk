<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Routine;
use App\Support\Constants;
use Livewire\Livewire;
use App\Http\Livewire\Routines\Index;
use Tests\DuskTestCase;

class RoutinesTest extends DuskTestCase
{
  
  public function insertDate($diff,$inputId){
    $this->browse(function ($browser) use ($diff,$inputId) {
      $browser->script('
        var dateString = new Date().toISOString().substring(0, 16).replace("T"," ");
            if (dateString !== "") {
        
                var dateVal = new Date(dateString);
                var day = dateVal.getDate().toString().padStart(2, "0");
                var month = (1 + dateVal.getMonth() + '.$diff.').toString().padStart(2, "0");
                var hour = dateVal.getHours().toString().padStart(2, "0");
                var minute = dateVal.getMinutes().toString().padStart(2, "0");
                var sec = dateVal.getSeconds().toString().padStart(2, "0");
                var ms = dateVal.getMilliseconds().toString().padStart(3, "0");
                var inputDate = dateVal.getFullYear() + "-" + (month) + "-" + (day) + "T" + (hour) + ":" + (minute);
        
                document.querySelector("[id='.$inputId.']").value=(inputDate);
            }
        ');
      });
    }

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
        //dump($generateRoutine['entranced_at']);
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
            ->pause(1000)
            ->type('#checkpoint_obs', $generateRoutine['checkpoint_obs'])
            ->select('#entranced_user_id', rand(2,9))
            ->select('#exited_user_id', rand(2,9));
            $this->insertDate(0,'entranced_at');
            $this->insertDate(1,'exited_at');
          $browser
            ->screenshot('1')
            ->script('document.querySelectorAll("#submitButton")[0].click();');
          $browser
            ->assertPathIs('/routines')
            ->assertSee('Rotina adicionada com sucesso!');
        });
    }

    /**
     * @test
     * @group testEditRoutine
     * @group link
     */

     // Dusk - Edita uma Rotina
     public function testEditRoutine()
    {
      
      $user = User::factory()->create();
      $user->assign(Constants::ROLE_ADMINISTRATOR);
      $user->allow('*');
      $user->save();
      $routine = Routine::all()->random(1)->toArray()[0];
      
      $this->browse(function ($browser) use ($user,$routine) {
        $browser
          ->loginAs($user->id)
          ->visit('/routines')
          ->assertSee('Rotinas')
          ->press('@manageRoutine-'.$routine['id'])
          ->assertPathIs('/routines/'.$routine['id'])
          ->type('#checkpoint_obs', str_random(15))
          ->script('document.querySelectorAll("#submitButton")[0].click();');
        $browser
        ->assertPathIs('/routines')
        ->assertSee('Rotina alterada com sucesso!');
    });
  }
}
