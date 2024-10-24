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
            $table->timestamp('started_at')->nullable();
            $table->timestamp('concluded_at')->nullable();
            $table->integer('visitor_id');
            $table->integer('destiny_sector_id');
            $table->integer('duty_user_id');
            $table->bigInteger('protocol_number');
            $table->text('description')->nullable();
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
                ->foreign('visitor_id')
                ->references('id')
                ->on('visitors');
            $table
                ->foreign('destiny_sector_id')
                ->references('id')
                ->on('sectors');
            $table
                ->foreign('duty_user_id')
                ->references('id')
                ->on('users');
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
