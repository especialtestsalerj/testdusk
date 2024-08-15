<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->text('hash');
            $table->text('drive');
            $table->text('path');
            $table->text('mime_type');
            $table->unsignedBigInteger('size')->nullable();


            $table
                ->unsignedBigInteger('created_by_id')
                ->unsigned()
                ->nullable();
            $table
                ->foreign('created_by_id')
                ->references('id')
                ->on('users');

            $table
                ->unsignedBigInteger('updated_by_id')
                ->unsigned()
                ->nullable();
            $table
                ->foreign('updated_by_id')
                ->references('id')
                ->on('users');

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
        Schema::dropIfExists('files');
    }
};
