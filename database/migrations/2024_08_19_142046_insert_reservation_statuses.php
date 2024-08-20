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
        DB::table('reservation_statuses')->insert([
            ['name' => 'AGUARDANDO CONFIRMAÇÃO DO VISITANTE', 'status' => true],
            ['name' => 'NÃO COMPARECEU', 'status' => true],
        ]);
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('reservation_statuses')
            ->where('status', 'Aguardando confirmação')
            ->orWhere('status', 'No show')
            ->delete();
    }
};
