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
        Schema::table('caution_weapons', function (Blueprint $table) {
            $table
                ->timestamp('exited_at')
                ->nullable(true)
                ->change();
        });

        $affected = DB::update(
            'UPDATE caution_weapons T1 SET exited_at = T2.concluded_at FROM cautions T2 WHERE T1.caution_id = T2.id AND T1.entranced_at = T1.exited_at'
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('caution_weapons', function (Blueprint $table) {
            $table
                ->timestamp('exited_at')
                ->nullable(false)
                ->change();
        });

        $affected = DB::update(
            'UPDATE caution_weapons T1 SET exited_at = T2.entranced_at FROM cautions T2 WHERE T1.caution_id = T2.id AND T1.exited_at = T2.concluded_at'
        );
    }
};
