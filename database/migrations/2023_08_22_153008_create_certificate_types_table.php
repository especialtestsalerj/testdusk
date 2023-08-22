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

        Schema::create('certificate_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('status');
        });

        Schema::enableForeignKeyConstraints();

        DB::table('certificate_types')->insert([
            ['id' => 1, 'name' => 'PARTICULAR', 'status' => true],
            ['id' => 2, 'name' => 'AERONAUTICA', 'status' => true],
            ['id' => 3, 'name' => 'CAC', 'status' => true],
            ['id' => 4, 'name' => 'CAC - PORTE FEDERAL', 'status' => true],
            ['id' => 5, 'name' => 'CBMERJ', 'status' => true],
            ['id' => 6, 'name' => 'EXERCITO BR', 'status' => true],
            ['id' => 7, 'name' => 'EXTERNO', 'status' => true],
            ['id' => 8, 'name' => 'FUNCIOINARIO', 'status' => true],
            ['id' => 9, 'name' => 'GCM', 'status' => true],
            ['id' => 10, 'name' => 'GCM CARDOSO MOREIRA', 'status' => true],
            ['id' => 11, 'name' => 'MBR', 'status' => true],
            ['id' => 12, 'name' => 'MBRJ', 'status' => true],
            ['id' => 13, 'name' => 'PCERJ', 'status' => true],
            ['id' => 14, 'name' => 'PCESP', 'status' => true],
            ['id' => 15, 'name' => 'PF', 'status' => true],
            ['id' => 16, 'name' => 'PMERJ', 'status' => true],
            ['id' => 17, 'name' => 'PPERJ', 'status' => true],
            ['id' => 18, 'name' => 'PPSP', 'status' => true],
            ['id' => 19, 'name' => 'PRESIDENCIA', 'status' => true],
            ['id' => 20, 'name' => 'SEAP', 'status' => true],
            ['id' => 21, 'name' => 'VISITANTE', 'status' => true],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certificate_types');
    }
};
