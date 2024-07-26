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
        Schema::table('reservations', function (Blueprint $table) {
            $table
                ->bigInteger('confirmed_by_id')
                ->unsigned()
                ->nullable();

            $table->timestamp('confirmed_at')->nullable();

            $table
                ->bigInteger('canceled_by_id')
                ->unsigned()
                ->nullable();

            $table->timestamp('canceled_at')->nullable();



        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reservations', function (Blueprint $table) {

            $table->dropColumn('confirmed_by_id');
            $table->dropColumn('confirmed_at');
            $table->dropColumn('canceled_by_id');
            $table->dropColumn('canceled_at');
        });
    }
};
