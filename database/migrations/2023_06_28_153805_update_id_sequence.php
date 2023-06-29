<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        DB::statement('ALTER TABLE people ALTER COLUMN id DROP DEFAULT');

        // Get the maximum ID value
        $maxId = DB::table('people')->max('id');

        // Set the next auto-increment value
        DB::statement("SELECT setval('people_id_seq', " . ($maxId + 1) . ', false)');

        // Enable auto-increment
        DB::statement(
            'ALTER TABLE people ALTER COLUMN id SET DEFAULT nextval(\'people_id_seq\'::regclass)'
        );
    }

    public function down()
    {
        // Reverse the migration if needed
    }
};
