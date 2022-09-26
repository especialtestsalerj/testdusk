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
        Schema::create('visitors', function (Blueprint $table) {
            $table->id();
            $table->integer('routine_id');
            $table->timestamp('entranced_at');
            $table->timestamp('exited_at')->nullable();
            $table->integer('duty_user_id');
            $table->integer('person_id');
            $table->integer('sector_id')->nullable();
            $table->text('description');
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
                ->foreign('sector_id')
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
        Schema::dropIfExists('visitors');
    }
};
