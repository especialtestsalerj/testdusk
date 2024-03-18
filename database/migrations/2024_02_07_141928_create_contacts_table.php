<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('contacts', function (Blueprint $table) {

            $table->id();

            $table->integer('person_id');
            $table
                ->foreign('person_id')
                ->references('id')
                ->on('people');

            $table->integer('contact_type_id');
            $table
                ->foreign('contact_type_id')
                ->references('id')
                ->on('contact_types');

            $table->string('contact');

            $table->boolean('status');

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

    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
