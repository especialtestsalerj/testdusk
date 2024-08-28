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
        Schema::table('sectors', function (Blueprint $table) {
            $table->boolean('display_remaining_vacancies')->default(false);
            $table->integer('max_date')->default(30);
            $table->boolean('required_motivation')->default(true);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sectors', function (Blueprint $table) {
            $table->dropColumn('display_remaining_vacancies');
            $table->dropColumn('max_date');
            $table->dropColumn('required_motivation');

        });
    }
};
