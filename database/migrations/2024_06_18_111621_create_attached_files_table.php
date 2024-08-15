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
        Schema::create('attached_files', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('file_id')->index()->nullable();
            $table
                ->foreign('file_id')
                ->references('id')
                ->on('files');

            $table->unsignedBigInteger('fileable_id')->index()->nullable();
            $table->string('fileable_type');
            $table->text('original_name');

            $table->index(['fileable_id', 'fileable_type']);

            $table->timestamps();

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

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attached_files');
    }
};
