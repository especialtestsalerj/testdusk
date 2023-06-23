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

        Schema::create('genders', function (Blueprint $table) {
            $table->id();
            $table->string('name');
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

        DB::table('genders')->insert([
            ['name' => 'MASCULINO', 'status' => true],
            ['name' => 'FEMININO', 'status' => true],
            ['name' => 'NÃO INFORMADO', 'status' => true],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('genders');
    }
};
