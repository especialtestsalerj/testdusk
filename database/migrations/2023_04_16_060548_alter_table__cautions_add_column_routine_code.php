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
        Schema::table('routines', function (Blueprint $table) {
            $table->integer('code')->nullable(true);
        });

        $affected = DB::update('UPDATE routines SET code = id');

        Schema::table('routines', function (Blueprint $table) {
            $table->unique('code', 'routines_code_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('routines', function (Blueprint $table) {
            $table->dropUnique('routines_code_unique');
            $table->dropColumn('code');
        });
    }
};
