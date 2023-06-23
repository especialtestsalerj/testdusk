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

        Schema::create('disability_types', function (Blueprint $table) {
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

        DB::table('disability_types')->insert([
            ['name' => 'DEFICIÊNCIA AUDITIVA', 'status' => true],
            ['name' => 'DEFICIÊNCIA FÍSICA', 'status' => true],
            ['name' => 'DEFICIÊNCIA INTELECTUAL', 'status' => true],
            ['name' => 'DEFICIÊNCIA MENTAL', 'status' => true],
            ['name' => 'DEFICIÊNCIA PSICOSSOCIAL', 'status' => true],
            ['name' => 'DEFICIÊNCIA VISUAL', 'status' => true],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('disability_types');
    }
};
