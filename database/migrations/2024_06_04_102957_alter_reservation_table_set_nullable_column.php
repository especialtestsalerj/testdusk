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
            $table->dropColumn('reservation_time');

            $table
                ->bigInteger('building_id')
                ->unsigned()
                ->nullable()
                ->default(Constants::LUCIO_COSTA_BUILDING_ID);

            $table
                ->foreign('building_id')
                ->references('id')
                ->on('buildings');

            $table
                ->bigInteger('capacity_id')
                ->unsigned();

            $table
                ->foreign('capacity_id')
                ->references('id')
                ->on('capacities');
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
            $table->integer('group_id')->nullable(false)->change();
            $table->integer('person_id')->nullable();
            $table->dropColumn('capacity_id')->nullable();
            $table->time('reservation_time')->nullable();
            $table->dropColumn('person');
            $table->dropColumn('building_id');
        });
    }
};
