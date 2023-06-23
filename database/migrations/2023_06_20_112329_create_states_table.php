<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('states', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->char('initial');
            $table->boolean('status');
            $table
                ->bigInteger('created_by_id')
                ->unsigned()
                ->nullable();
            $table
                ->bigInteger('updated_by_id')
                ->unsigned()
                ->nullable();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();

        DB::table('states')->insert([
            ['id' => 11, 'name' => 'Rondônia', 'initial' => 'RO', 'status' => true],
            ['id' => 12, 'name' => 'Acre', 'initial' => 'AC', 'status' => true],
            ['id' => 13, 'name' => 'Amazonas', 'initial' => 'AM', 'status' => true],
            ['id' => 14, 'name' => 'Roraima', 'initial' => 'RR', 'status' => true],
            ['id' => 15, 'name' => 'Pará', 'initial' => 'PA', 'status' => true],
            ['id' => 16, 'name' => 'Amapá', 'initial' => 'AP', 'status' => true],
            ['id' => 17, 'name' => 'Tocantins', 'initial' => 'TO', 'status' => true],
            ['id' => 21, 'name' => 'Maranhão', 'initial' => 'MA', 'status' => true],
            ['id' => 22, 'name' => 'Piauí', 'initial' => 'PI', 'status' => true],
            ['id' => 23, 'name' => 'Ceará', 'initial' => 'CE', 'status' => true],
            ['id' => 24, 'name' => 'Rio Grande do Norte', 'initial' => 'RN', 'status' => true],
            ['id' => 25, 'name' => 'Paraíba', 'initial' => 'PB', 'status' => true],
            ['id' => 26, 'name' => 'Pernambuco', 'initial' => 'PE', 'status' => true],
            ['id' => 27, 'name' => 'Alagoas', 'initial' => 'AL', 'status' => true],
            ['id' => 28, 'name' => 'Sergipe', 'initial' => 'SE', 'status' => true],
            ['id' => 29, 'name' => 'Bahia', 'initial' => 'BA', 'status' => true],
            ['id' => 31, 'name' => 'Minas Gerais', 'initial' => 'MG', 'status' => true],
            ['id' => 32, 'name' => 'Espírito Santo', 'initial' => 'ES', 'status' => true],
            ['id' => 33, 'name' => 'Rio de Janeiro', 'initial' => 'RJ', 'status' => true],
            ['id' => 35, 'name' => 'São Paulo', 'initial' => 'SP', 'status' => true],
            ['id' => 41, 'name' => 'Paraná', 'initial' => 'PR', 'status' => true],
            ['id' => 42, 'name' => 'Santa Catarina', 'initial' => 'SC', 'status' => true],
            ['id' => 43, 'name' => 'Rio Grande do Sul', 'initial' => 'RS', 'status' => true],
            ['id' => 50, 'name' => 'Mato Grosso do Sul', 'initial' => 'MS', 'status' => true],
            ['id' => 51, 'name' => 'Mato Grosso', 'initial' => 'MT', 'status' => true],
            ['id' => 52, 'name' => 'Goiás', 'initial' => 'GO', 'status' => true],
            ['id' => 53, 'name' => 'Distrito Federal', 'initial' => 'DF', 'status' => true],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('states');
    }
};
