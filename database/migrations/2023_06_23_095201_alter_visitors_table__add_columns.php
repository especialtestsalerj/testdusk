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
        Schema::table('people', function (Blueprint $table) {
            $table->string('id_card')->nullable();
            $table->string('certificate_type')->nullable(); // público / privado
            $table->string('certificate_number')->nullable();
            $table->date('certificate_valid_until')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('people', function (Blueprint $table) {
            $table->dropColumn('id_card');
            $table->dropColumn('certificate_type');
            $table->dropColumn('certificate_number');
            $table->dropColumn('certificate_valid_until');
        });
    }
};
