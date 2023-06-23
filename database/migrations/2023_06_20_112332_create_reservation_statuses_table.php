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

        Schema::create('reservation_statuses', function (Blueprint $table) {
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

        DB::table('reservation_statuses')->insert([
            ['name' => 'AGUARDANDO CONFIRMAÇÃO', 'status' => true],
            ['name' => 'VISITA AGENDADA', 'status' => true],
            ['name' => 'VISITA EM ANDAMENTO', 'status' => true],
            ['name' => 'VISITA REALIZADA', 'status' => true],
            ['name' => 'VISITA CANCELADA', 'status' => true],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservation_statuses');
    }
};
