<?php

namespace Tests\Browser\Traits;

use App\Models\Building;
use App\Models\Capacity;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Faker\Factory as Faker;

trait SchedulingTestHelper
{
    /**
     * Seleciona aleatoriamente um edifício, setor e capacity, além de gerar dados aleatórios para o formulário.
     *
     * @return array
     * @throws \Exception
     */
    protected function getRandomSchedulingData()
    {
        $faker = Faker::create('pt_BR');

        $randomBuilding = Building::whereHas('sectors.capacities')
            ->with(['sectors.capacities'])
            ->inRandomOrder()
            ->first();

        if (!$randomBuilding) {
            throw new \Exception('Nenhum edifício com setores e capacities encontrados.');
        }

        $sectorsWithCapacities = $randomBuilding->sectors->filter(function ($sector) {
            return $sector->capacities->isNotEmpty();
        });

        if ($sectorsWithCapacities->isEmpty()) {
            throw new \Exception('Nenhum setor com capacities encontrado para o edifício selecionado.');
        }

        $randomSector = $sectorsWithCapacities->random();

        $randomCapacity = $randomSector->capacities->random();

        if (!$randomCapacity) {
            throw new \Exception('Nenhuma capacity encontrada para o setor selecionado.');
        }

        $documentTypes = ['1', '4']; // CPF e Passaporte
        $documentType = $faker->randomElement($documentTypes);
        $documentNumber = $documentType === '1' ? $faker->numerify('###########') : $faker->randomNumber(8, true);;
        $birthdate = $faker->date('Y-m-d', '-18 years'); // Garante que a idade seja mínima de 18 anos
        $contact = $faker->phoneNumber;
        $email = $faker->unique()->safeEmail;
        $confirmEmail = $email;
        $hasDisability = $faker->boolean;
        $motive = $faker->sentence;
        $hasGroup = $faker->boolean;
        $institution = $hasGroup ? $faker->company : null;


        $country = config('app.country_br');
        $state = config('app.state_rj');
        $city = config('app.city_rio');

        return [
            'building' => $randomBuilding,
            'sector' => $randomSector,
            'capacity' => $randomCapacity,
            'fullName' => $faker->name,
            'socialName' => $faker->firstName,
            'documentType' => $documentType,
            'documentNumber' => $documentNumber,
            'birthdate' => $birthdate,
            'contact' => $contact,
            'country' => $country,
            'state' => $state,
            'city' => $city,
            'email' => $email,
            'confirmEmail' => $confirmEmail,
            'hasDisability' => $hasDisability,
            'motive' => $motive,
            'hasGroup' => $hasGroup,
            'institution' => $institution,
        ];
    }

    /**
     * Gera dados inválidos para testes de erro.
     *
     * @return array
     */
    protected function getInvalidSchedulingData()
    {
        $faker = Faker::create('pt_BR');

        return [
            'fullName' => '', // Nome completo vazio (campo obrigatório)
            'email' => 'invalid-email', // Email inválido
            'confirmEmail' => 'different-email@example.com', // Confirmação de email diferente
            'documentNumber' => '123', // Número de documento inválido
            'birthdate' => '2025-01-01', // Data futura (inválida)
            'contact' => 'invalid-phone', // Telefone inválido
            // Adicione outros campos inválidos conforme necessário
        ];
    }

}
