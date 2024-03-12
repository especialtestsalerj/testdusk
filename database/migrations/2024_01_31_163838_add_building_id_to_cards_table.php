<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Support\Constants;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('cards', function (Blueprint $table) {
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

    public function down(): void
    {
        Schema::table('cards', function (Blueprint $table) {
            $table->dropColumn('building_id');
        });
    }
};
