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

        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->integer('group_id');
            $table
                ->foreign('group_id')
                ->references('id')
                ->on('groups');
            $table->integer('reservation_type_id');
            $table
                ->foreign('reservation_type_id')
                ->references('id')
                ->on('reservation_types');
            $table->string('code')->unique();
            $table->date('reservation_date');
            $table->time('reservation_time');
            $table->integer('sector_id');
            $table
                ->foreign('sector_id')
                ->references('id')
                ->on('sectors');
            $table->integer('person_id');
            $table
                ->foreign('person_id')
                ->references('id')
                ->on('people');
            $table->integer('reservation_status_id');
            $table
                ->foreign('reservation_status_id')
                ->references('id')
                ->on('reservation_statuses');
            $table->char('responsible_person_type')->nullable();
            $table->string('responsible_name')->nullable();
            $table->string('responsible_email')->nullable();
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
        Schema::dropIfExists('reservations');
    }
};
