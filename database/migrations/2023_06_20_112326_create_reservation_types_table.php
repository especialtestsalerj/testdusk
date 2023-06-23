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

        Schema::create('reservation_types', function (Blueprint $table) {
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

        DB::table('reservation_types')->insert([
            ['name' => 'ONLINE', 'status' => true],
            ['name' => 'PRESENCIAL', 'status' => true],
            ['name' => 'TERCEIROS', 'status' => true],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservation_types');
    }
};
