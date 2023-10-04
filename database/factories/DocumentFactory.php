<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Person;
use App\Models\DocumentType;
use App\Models\State;
use App\Models\Document;
use App\Models\User;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Document>
 */
class DocumentFactory extends Factory
{
    protected $model = Document::class;

    function generateCPF()
    {
        $faker = $this->faker;
        $cpf = $faker->unique()->numerify('#########'); // Generate 9 random digits

        // Calculate the first validation digit
        $sum = 0;
        for ($i = 0; $i < 9; $i++) {
            $sum += $cpf[$i] * (10 - $i);
        }
        $firstDigit = ($sum % 11 < 2) ? 0 : 11 - ($sum % 11);
        $cpf .= $firstDigit;

        // Calculate the second validation digit
        $sum = 0;
        for ($i = 0; $i < 10; $i++) {
            $sum += $cpf[$i] * (11 - $i);
        }
        $secondDigit = ($sum % 11 < 2) ? 0 : 11 - ($sum % 11);
        $cpf .= $secondDigit;

        return substr($cpf, 0, 3) . '.' . substr($cpf, 3, 3) . '.' . substr($cpf, 6, 3) . '-' . substr($cpf, 9, 2);
    }

    public function definition()
    {
        $person = Person::inRandomOrder()->first();
        $state = State::inRandomOrder()->first();
        $documentType = DocumentType::inRandomOrder()->first();

        //TODO: Preencher número de documento de acordo com o tipo de documento


        switch($documentType->name){
            case 'CPF':
                $documentNumber = only_numbers($this->generateCPF());
                break;
            case 'PASSAPORTE':
                $documentNumber = $this->generatePassportNumber();
                break;
            default:
                $documentNumber = $this->faker->numerify('########');
                break;
        }

        return [
            'person_id' => $person->id,
            'document_type_id' => $documentType->id,
            'number' => $documentNumber,
            'state_id' => $state->id,
            'created_by_id' => User::inRandomOrder()->first()->id,
            'updated_by_id' => User::inRandomOrder()->first()->id,
            'created_at' => $this->faker->dateTime(),
            'updated_at' => $this->faker->dateTime(),
            'issuing_authority' => $this->faker->text(255),
        ];
    }

    /**
     * @param $faker
     * @return void
     */
    protected function generatePassportNumber(): string
    {
        $passportNumber = '';
        for ($i = 0; $i < 8; $i++) {
            // Randomly decide whether to add a letter or a number
            if ($this->faker->boolean(25)) {
                // Add a random uppercase letter
                $passportNumber .= $this->faker->randomLetter;
            } else {
                // Add a random number
                $passportNumber .= $this->faker->randomDigit;
            }
        }
        return to_upper($passportNumber);
    }
}
