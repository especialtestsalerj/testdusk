<?php

namespace Tests\Browser;

use App\Models\City;
use App\Models\Country;
use App\Models\DocumentType;
use App\Models\Person;
use App\Models\Document;
use App\Models\State;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Livewire\Livewire;
use Tests\TestCase;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\Livewire\People\Modal as PeopleModal;

class CreatePersonFromModalTest extends TestCase
{
//    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_person()
    {
        // Arrange
        $person = Person::factory()->make();
        $document = Document::factory()->make();

        Livewire::
            test(PeopleModal::class, ['person_id' => $person->id])
            ->set('document_type_id', $document->document_type_id)
            ->set('document_number', $document->number) // Set your desired document number
            ->set('state_document_id', $state->id)
            ->set('full_name', $person->full_name) // Set your desired full name
            ->set('country_id', $person->country_id)
            ->set('state_id', $person->state_id)
            ->set('city_id', $person->city_id) // Set your desired city ID
//            ->set('other_city', 'Other City') // Set your desired other city name
            ->call('save');

        $this->assertDatabaseHas('documents', [
            'document_type_id' => $document->document_type_id,
            'number' => $document->number,
        ]);

        // Assert
        $this->assertDatabaseHas('people', [
            'full_name' => $person->full_name,
            'country_id' => $country->id,
            'state_id' => $state->id,
            'city_id' => $city->id,
        ]);
    }
}
