<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('reservation_histories', function (Blueprint $table) {
            $table->id()->foreign('reservations.id');
            $table->integer('reservation_id');
            $table->timestamp('occurred_at');
            $table->integer('reservation_status_id');
            $table
                ->foreign('reservation_status_id')
                ->references('id')
                ->on('reservation_statuses');
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
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservation_histories');
    }
};
