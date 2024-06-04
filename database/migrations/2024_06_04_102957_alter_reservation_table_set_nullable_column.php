<?php

use App\Support\Constants;
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
            $table->integer('group_id')->nullable()->change();
            $table->json('person');
            $table->dropColumn('person_id');

            $table
                ->bigInteger('building_id')
                ->unsigned()
                ->nullable()
                ->default(Constants::LUCIO_COSTA_BUILDING_ID);

            $table
                ->foreign('building_id')
                ->references('id')
                ->on('buildings');
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
//            $table->integer('group_id')->nullable(false)->change();
            $table->integer('person_id')->nullable();
            $table->dropColumn('person');
        });
    }
};
