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
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->char('cpf', 11);
            $table->string('full_name');
            $table->string('origin')->nullable();
            $table->string('id_card')->nullable();
            $table->string('certificate_type')->nullable(); // público / privado
            $table->string('certificate_number')->nullable();
            $table->date('certificate_valid_until')->nullable();
            $table->string('photo')->nullable();
            $table->text('alert_obs')->nullable();
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
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('people');
    }
};
