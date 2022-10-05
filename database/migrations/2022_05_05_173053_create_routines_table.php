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
            $table->integer('shift_id');
            $table->timestamp('entranced_at');
            $table->integer('entranced_user_id');
            $table->text('entranced_obs')->nullable();
            $table->text('checkpoint_obs')->nullable();
            $table->timestamp('exited_at')->nullable();
            $table->integer('exited_user_id')->nullable();
            $table->text('exited_obs')->nullable();
            $table->boolean('status')->default(true);
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
                ->foreign('shift_id')
                ->references('id')
                ->on('shifts');
            $table
                ->foreign('entranced_user_id')
                ->references('id')
                ->on('users');
            $table
                ->foreign('exited_user_id')
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
        Schema::table('routines', function (Blueprint $table) {
            //$table->dropForeign('entrance_user_id_foreign');
            //$table->dropForeign('entrance_shift_id_foreign');
            //$table->dropForeign('exit_user_id_foreign');
            Schema::dropIfExists('routines');
        });
    }
};
