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

        Schema::rename('people', 'people2');

        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->string('full_name')->index();
            $table->string('social_name')->nullable();
            $table->date('birthdate')->nullable();
            $table->integer('gender_id')->nullable();
            $table
                ->foreign('gender_id')
                ->references('id')
                ->on('genders');
            $table->boolean('has_disability')->nullable();
            $table->integer('city_id')->nullable();
            $table
                ->foreign('city_id')
                ->references('id')
                ->on('cities');
            $table->string('other_city')->nullable();
            $table->integer('state_id')->nullable();
            $table
                ->foreign('state_id')
                ->references('id')
                ->on('states');
            $table->integer('country_id')->nullable();
            $table
                ->foreign('country_id')
                ->references('id')
                ->on('countries');
            $table->string('email')->nullable();
            $table->binary('photo')->nullable();
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
        Schema::dropIfExists('people');
        Schema::rename('people2', 'people');
    }
};
