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
        Schema::create('routines', function (Blueprint $table) {
            $table->id();
            $table->date('entrance_date');
            $table->integer('entrance_user_id');
            $table->integer('entrance_shift_id');
            $table->text('entrance_obs')->nullable();
            $table->text('checkpoint_obs')->nullable();
            $table->date('exit_date')->nullable();
            $table->integer('exit_user_id')->nullable();
            $table->text('exit_obs')->nullable();
            $table->timestamps();

            $table
                ->foreign('entrance_user_id')
                ->references('id')
                ->on('users');
            $table
                ->foreign('entrance_shift_id')
                ->references('id')
                ->on('shift');
            $table
                ->foreign('exit_user_id')
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
        Schema::dropIfExists('routines');
    }
};
