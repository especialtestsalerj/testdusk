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
        Schema::table('visitors', function (Blueprint $table) {
            $table->dropColumn('duty_user_id');
        });


        Schema::table('visitors', function (Blueprint $table) {
            $table->dropForeign('<FK-name>');
            $table->dropColumn('<FK-columnName>');
        });
        Schema::table('visitors', function (Blueprint $table) {
            $table->foreignId('<FK-columnName>')->constrained()->cascadeOnDelete();
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
            $table->integer('duty_user_id')->nullable();
        });

    }
};
