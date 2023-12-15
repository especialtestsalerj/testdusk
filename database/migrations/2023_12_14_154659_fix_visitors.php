<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::update(
            "UPDATE sector_visitor SET sector_id = 269 WHERE sector_id = 51 AND visitor_id IN (
               SELECT v.id FROM visitors v INNER JOIN sector_visitor sv ON v.id = sv.visitor_id WHERE sv.sector_id = 51 AND DATE(v.entranced_at) >= '2023-11-30'
             )"
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::update(
            "UPDATE sector_visitor SET sector_id = 51 WHERE sector_id = 269 AND visitor_id IN (
               SELECT v.id FROM visitors v INNER JOIN sector_visitor sv ON v.id = sv.visitor_id WHERE sv.sector_id = 269 AND DATE(v.entranced_at) >= '2023-11-30'
             )"
        );
    }
};
