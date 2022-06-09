<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cautions', function (Blueprint $table) {
            $table->id();
            $table->integer('routine_id');
            $table->integer('duty_user_id');
            $table->integer('person_id');
            $table->integer('destiny_sector_id');
            $table->string('protocol_number');
            $table->timestamp('concluded_at');
            $table
                ->bigInteger('created_by_id')
                ->unsigned()
                ->nullable();
            $table
                ->bigInteger('updated_by_id')
                ->unsigned()
                ->nullable();
            $table->timestamps();

            $table
                ->foreign('routine_id')
                ->references('id')
                ->on('routines');
            $table
                ->foreign('duty_user_id')
                ->references('id')
                ->on('users');
            $table
                ->foreign('person_id')
                ->references('id')
                ->on('people');
            $table
                ->foreign('destiny_sector_id')
                ->references('id')
                ->on('sectors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cautions');
    }
};
