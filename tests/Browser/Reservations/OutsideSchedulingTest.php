<?php

namespace Tests\Browser\Reservations;

use Laravel\Dusk\Browser;
use Tests\Browser\Traits\SchedulingTestHelper;
use Tests\DuskTestCase;
use App\Models\Building;

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
                ->select('@sector_id', $data['sector']->id)
                // Preenche a data da visita
                ->type('@reservation_date', date('d/m/Y', strtotime($data['birthdate'])))
                // Seleciona a capacity (hora da visita)
                ->select('@capacity_id', $data['capacity']->id)
                // Preenche o campo de nome completo
                ->type('@full_name', $data['fullName'])
                // Preenche o campo de nome social
                ->type('@social_name', $data['socialName'])
                // Seleciona o tipo de documento
                ->select('@document_type_id', $data['documentType'])
                // Preenche o número do documento
                ->type('@document_number', $data['documentNumber'])
                // Preenche a data de nascimento
                ->type('@birthdate', $data['birthdate'])
                ->screenshot('Agendamento_realizado_com_sucesso')
                // Alterna o switch de deficiência, se necessário
//                ->when($data['hasDisability'], function ($browser) {
//                    $browser->check('@has_disability');
//                })

                // Preenche o país
                ->select('@country_id', 1) // Ajuste conforme sua lógica

                // Preenche o estado
                ->select('@state_id', 1) // Ajuste conforme sua lógica

                // Preenche a cidade
                ->select('@city_id', 1) // Ajuste conforme sua lógica

                // Preenche o email
                ->type('@responsible_email', $data['email'])

                // Preenche a confirmação de email
                ->type('@confirm_email', $data['confirmEmail'])

                // Preenche o telefone de contato
                ->type('@contact', $data['contact'])

                // Alterna o switch de visita em grupo, se necessário
//                ->when($data['hasGroup'], function ($browser) use ($data) {
//                    $browser->check('@has_group')
//                        ->type('@institution', $data['institution']);
//                })

                // Preenche o motivo da visita, se o setor requer
                ->when($data['sector']->required_motivation, function ($browser) use ($data) {
                    $browser->type('@motive', $data['motive']);
                })

                // Preenche os membros do grupo, se houver
//                ->when($data['hasGroup'], function ($browser) use ($data) {
//                    // Adiciona um membro do grupo
//                    $browser->click('@add-person-button') // Assegure-se de que o botão para adicionar pessoa tenha o atributo dusk="add-person-button"
//                    ->type('@inputs_0_name', $data['fullName']) // Você pode ajustar para gerar nomes diferentes
//                    ->select('@inputs_0_documentType', $data['documentType'])
//                        ->type('@inputs_0_document', $data['documentNumber']);
//                    // Adicione mais membros conforme necessário
//                })

                // Preenche o ReCAPTCHA, se possível
                // Nota: Automatizar o ReCAPTCHA pode ser complexo. Considere desativá-lo no ambiente de teste.

                // Clica no botão de solicitar
                ->click('@submitButton')

                // Aguarda a mensagem de sucesso
                ->waitForText('Agendamento realizado com sucesso', 10)

                // Verifica se a mensagem de sucesso está visível
                ->assertSee('Agendamento realizado com sucesso');

                // Tira um screenshot para verificação

        });
    }
}
