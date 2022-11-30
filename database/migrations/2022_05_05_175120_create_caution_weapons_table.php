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
        Schema::create('caution_weapons', function (Blueprint $table) {
            $table->id();
            $table->integer('caution_id');
            $table->timestamp('entranced_at');
            $table->timestamp('exited_at');
            $table->string('register_number')->nullable();
            $table->integer('weapon_type_id');
            $table->text('weapon_description')->nullable();
            $table->string('weapon_number')->nullable();
            $table->integer('cabinet_id')->nullable();
            $table->integer('shelf_id')->nullable();
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
                ->foreign('caution_id')
                ->references('id')
                ->on('cautions');
            $table
                ->foreign('weapon_type_id')
                ->references('id')
                ->on('weapon_types');
            $table
                ->foreign('cabinet_id')
                ->references('id')
                ->on('cabinets');
            $table
                ->foreign('shelf_id')
                ->references('id')
                ->on('shelves');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('caution_weapons');
    }
};
