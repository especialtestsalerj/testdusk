<?php

namespace Tests\Browser;

use App\Models\Person;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Silber\Bouncer\Database\Role;
use Tests\DuskTestCase;

class VisitorTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function testExample(): void
    {

        $this->browse(function (Browser $browser) {
            $adminUser = $this->getAdmin(); //trocar para portaria
            $person = Person::factory()->make();

            $browser->loginAs($adminUser)
                ->visitRoute('visitors.create')
                ->type('@full_name', $person->full_name)
                ->type('@social_name', $person->social_name);

            $this->fillAddress($browser, $person);

            $browser->screenshot('abc');

            $browser->assertSee('Brasil');
        });
    }

    /**
     * @return mixed
     */
    protected function getAdminUser()
    {
        return User::whereIs('ADMIN')->first();
    }

    /**
     * @return mixed
     */
    protected function getAdmin(): mixed
    {
        return $this->getAdminUser();
    }

    /**
     * @param Browser $browser
     * @return void
     */
    function selectSelect2(Browser $browser, $duskIdentifier, $newValue): void
    {
        $browser->script("$('[dusk=\"{$duskIdentifier}\"]').val('{$newValue}'); $('[dusk=\"{$duskIdentifier}\"]').trigger('change');");
    }

    /**
     * @param Browser $browser
     * @param mixed $person
     * @return void
     */
    function fillAddress(Browser $browser, mixed $person): void
    {
        $this->selectSelect2($browser, 'country_id', $person->country_id);

        $browser->pause(4000);

        $browser->type('@full_name', rand(1,200));

        if ($person->isBr) {
            $this->selectSelect2($browser, 'state_id', $person->state_id);

            $browser->type('@full_name', rand(1,200));

            $this->selectSelect2($browser, 'city_id', $person->city_id);
            $browser->type('@full_name', rand(1,200));

            $browser->pause(4000);
        } else {
            $browser->pause(4000);
            $browser->type('@full_name', rand(1,200));

            $browser->typeSlowly('@other_city', $person->other_city);
            $browser->type('@full_name', rand(1,200));
            $browser->pause(4000);
        }
    }
}
