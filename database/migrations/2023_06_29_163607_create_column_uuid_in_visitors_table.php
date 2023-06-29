<?php

use App\Models\Visitor;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Ramsey\Uuid\Uuid;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('visitors', function (Blueprint $table) {
            $table->uuid()->nullable();
        });

        foreach (Visitor::cursor() as $visitor) {
            $visitor->uuid = Uuid::uuid4();
            $visitor->save();
        }

        Schema::table('visitors', function (Blueprint $table) {
            $table
                ->uuid()
                ->nullable(false)
                ->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('visitors', function (Blueprint $table) {
            $table->dropcolumn('uuid');
        });
    }
};
