<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('contact_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('status');
            $table->timestamps();
        });

        DB::table('contact_types')->insert([
            ['name' => 'Celular', 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Telefone Fixo', 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Email', 'status' => true, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('contact_types');
    }
};
