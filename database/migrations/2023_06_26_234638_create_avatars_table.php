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
        Schema::create('avatars', function (Blueprint $table) {
            $table->id();

            $table->text('hash');
            $table->text('drive');
            $table->text('path');
            $table->text('mime_type');

            $table->timestamps();
        });

        Schema::table('visitors', function (Blueprint $table) {
            $table->unsignedInteger('avatar_id')->nullable();

            $table
                ->foreign('avatar_id')
                ->references('id')
                ->on('avatars');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('visitors', function (Blueprint $table) {
            $table->dropColumn('avatar_id');
        });

        Schema::dropIfExists('avatars');


    }
};
