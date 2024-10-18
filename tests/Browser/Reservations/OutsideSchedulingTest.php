<?php

namespace Tests\Browser\Reservations;

use Carbon\Carbon;
use Laravel\Dusk\Browser;
use Tests\Browser\Traits\SchedulingTestHelper;
use Tests\DuskTestCase;

class OutsideSchedulingTest extends DuskTestCase
{
    use SchedulingTestHelper;

    /**
     * Testa o agendamento selecionando um edifício aleatório existente.
     *
     * @return void
     */
    public function testRandomBuildingScheduling()
    {
        $this->browse(function (Browser $browser) {

            $data = $this->getRandomSchedulingData();

            $browser->visit('/agendamento')
                ->assertSee('Agendamentos de Visitas')
                ->select('@building_id', $data['building']->id)
                ->click('@schedule-button')
                ->waitFor('@scheduling-form')
                ->assertVisible('@scheduling-form')
                ->select('@sector_id', $data['sector']->id)
                ->waitUntilEnabled('@reservation_date')
                ->setFlatpickrDate('reservation_date', $data['reservationDate'])
                ->assertInputValue('@reservation_date', $data['reservationDate'])
                ->waitUntilEnabled('@capacity_id')
                ->select('@capacity_id', $data['capacity']->id)
                ->type('@full_name', $data['fullName'])
                ->type('@social_name', $data['socialName'])
                ->select('@document_type_id', $data['documentType'])
                ->typeSlowly('@document_number', $data['documentNumber'])
                ->keys('@birthdate', $data['birthdate'])
                ->select('@country_id', $data['country_id'])
                ->select('@state_id', $data['state_id'])
                ->select('@city_id', $data['city_id'])
                ->type('@responsible_email', $data['email'])
                ->typeSlowly('@confirm_email', $data['email'])
                ->typeSlowly('@contact', $data['contact']);

            if ($data['sector']->required_motivation) {
                $browser->waitFor('@motive')
                    ->type('@motive', $data['motive']);
            }

            $browser->click('@submitButton')
                ->waitForText('Resumo da Reserva!')
                ->assertSee('Resumo da Reserva!');

            $code = $browser->text('@reservation-code');

            $this->assertDatabaseHas('reservations', [
                'reservation_type_id' => 1,
                'code' => $code,
                'reservation_date' => Carbon::createFromFormat('d/m/Y', $data['reservationDate'])->format('Y-m-d'),
                'sector_id' => (int)$data['sector']->id,
                'reservation_status_id' => 1,
                'responsible_person_type' => null,
                'responsible_name' => null,
                'responsible_email' => $data['email'],
//                'created_by_id' => ,
//                'updated_by_id' => ,

//                'person' => $this->castAsJson([
//                    'full_name' => $data['fullName'],
//                    'social_name' => $data['socialName'],
//                    'document_type_id' => (string)$data['documentType'],
//                    'document_number' => $data['documentNumber'],
//                    'country_id' => $data['country_id'],
//                    'state_id' => $data['state_id'],
//                    'city_id' => $data['city_id'],
//                    'email' => $data['email'],
//                    'mobile' => $data['contact'],
//                    'has_disability' => $data['hasDisability'],
//                    'birthdate' => Carbon::createFromFormat('dmY', $data['birthdate'])->format('Y-m-d'),
//                ]),

                'motive' => $data['motive'],
                'capacity_id' => (int)$data['capacity']->id,
                'quantity' => 1,
                'building_id' => (int)$data['building']->id,
            ]);
        });

    }

    //                ->when($data['hasDisability'], function ($browser) {
//                    $browser->check('@has_disability');
//                })


    // Alterna o switch de visita em grupo, se necessário
//                ->when($data['hasGroup'], function ($browser) use ($data) {
//                    $browser->check('@has_group')
//                        ->type('@institution', $data['institution']);
//                })

    // Preenche o motivo da visita, se o setor requer
//                ->when($data['sector']->required_motivation, function ($browser) use ($data) {
//                    $browser->type('@motive', $data['motive']);
//                })


    // Preenche os membros do grupo, se houver
//                ->when($data['hasGroup'], function ($browser) use ($data) {
//                    // Adiciona um membro do grupo
//                    $browser->click('@add-person-button') // Assegure-se de que o botão para adicionar pessoa tenha o atributo dusk="add-person-button"
//                    ->type('@inputs_0_name', $data['fullName']) // Você pode ajustar para gerar nomes diferentes
//                    ->select('@inputs_0_documentType', $data['documentType'])
//                        ->type('@inputs_0_document', $data['documentNumber']);
//                    // Adicione mais membros conforme necessário
//                })
}
