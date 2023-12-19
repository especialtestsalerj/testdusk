<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        $maxId = DB::table('sectors')->max('id');
        DB::statement("ALTER SEQUENCE sectors_id_seq RESTART WITH " . ($maxId + 1));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Valor da Sequence em produção no momento da migration
        DB::statement('ALTER SEQUENCE sectors_id_seq RESTART WITH 188');
    }
};
