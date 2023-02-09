<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('weapon_types', function (Blueprint $table) {
            $affected = DB::update(
                "update weapon_types set name = 'FUZIL / ARMA LONGA' where name = ?",
                ['FUZIL']
            );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('weapon_types', function (Blueprint $table) {
            $affected = DB::update("update weapon_types set name = 'FUZIL' where name = ?", [
                'FUZIL / ARMA LONGA',
            ]);
        });
    }
};
