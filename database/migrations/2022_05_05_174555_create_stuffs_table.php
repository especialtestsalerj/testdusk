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
        Schema::create('stuffs', function (Blueprint $table) {
            $table->id();
            $table->integer('routine_id');
            $table->timestamp('entranced_at')->nullable();
            $table->timestamp('exited_at')->nullable();
            $table->integer('duty_user_id');
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
        Schema::dropIfExists('stuffs');
    }
};
