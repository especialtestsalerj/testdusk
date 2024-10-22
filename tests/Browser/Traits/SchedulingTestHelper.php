<?php

namespace Tests\Browser\Traits;

use App\Models\Building;
use App\Models\Capacity;
use Carbon\Carbon;
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
    protected function getRandomSchedulingData($hasGroup = false)
    {
        $faker = Faker::create('pt_BR');

        $randomBuilding = Building::whereHas('sectors', function($query) {
            $query->where('is_visitable', true)
                ->whereHas('capacities');
        })
            ->with(['sectors.capacities'])
            ->inRandomOrder()
            ->first();


        $sectorsWithCapacities = $randomBuilding->sectors->filter(function ($sector) {
            return $sector->is_visitable && $sector->capacities->isNotEmpty();
        });

        $randomSector = $sectorsWithCapacities->random();

        $randomCapacity = $randomSector->capacities->random();

        $documentTypes = ['1', '4']; // CPF e Passaporte
        $documentType = $faker->randomElement($documentTypes);
        $documentNumber = $documentType === '1' ? $faker->cpf(false) : $faker->randomNumber(8, true);;
        $birthdate = $faker->dateTime();
        $contact = $faker->phoneNumber;
        $email = $faker->freeEmail;
        $hasDisability = $faker->boolean;
        $motive = $faker->sentence;
        $institution = $hasGroup ? $faker->company : null;
        $reservationDate = Carbon::now()->format('d/m/Y');


        $country = config('app.country_br');
        $state = config('app.state_rj');
        $city = config('app.city_rio');

        // Inicializa o array de membros do grupo
        $groupMembers = [];

        if ($hasGroup) {
            // Gera um número aleatório de membros (por exemplo, entre 2 e 5)
            $numberOfMembers = $faker->numberBetween(2, 5);

            for ($i = 0; $i < $numberOfMembers; $i++) {
                $memberDocumentType = $faker->randomElement($documentTypes);
                $memberDocumentNumber = $memberDocumentType === '1' ? $faker->cpf(false) : $faker->randomNumber(8, true);

                $groupMembers[] = [
                    'name' => $faker->name,
                    'documentType' => $memberDocumentType,
                    'documentNumber' => $memberDocumentNumber,
                ];
            }
        }

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
            'country_id' => $country,
            'state_id' => $state,
            'city_id' => $city,
            'email' => $email,
            'hasDisability' => $hasDisability,
            'motive' => $motive,
            'hasGroup' => $hasGroup,
            'institution' => $institution,
            'groupMembers' => $groupMembers,
            'reservationDate' => $reservationDate,
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
