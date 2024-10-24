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

        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->integer('person_id');
            $table
                ->foreign('person_id')
                ->references('id')
                ->on('people');
            $table->integer('document_type_id');
            $table
                ->foreign('document_type_id')
                ->references('id')
                ->on('document_types');
            $table->string('number');
            $table->integer('state_id')->nullable();
            $table
                ->foreign('state_id')
                ->references('id')
                ->on('states');
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
        Schema::dropIfExists('documents');
    }
};
