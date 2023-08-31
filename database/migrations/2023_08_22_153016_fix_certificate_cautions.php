<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cautions', function (Blueprint $table) {
            $table->integer('certificate_type_id')->nullable();
            $table->string('certificate_number')->nullable();
            $table->date('certificate_valid_until')->nullable();
            $table
                ->foreign('certificate_type_id')
                ->references('id')
                ->on('certificate_types');
        });

        DB::update(
            'update cautions set
                certificate_type_id = (select ct.id from people2 pe inner join visitors v on pe.id = v.person_id inner join certificate_types ct on pe.origin = ct.name where v.id = visitor_id),
                certificate_number = (select pe.certificate_number from people2 pe inner join visitors v on pe.id = v.person_id where v.id = visitor_id),
                certificate_valid_until = (select pe.certificate_valid_until from people2 pe inner join visitors v on pe.id = v.person_id where v.id = visitor_id) '
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cautions', function (Blueprint $table) {
            $table->dropColumn('certificate_type_id');
            $table->dropColumn('certificate_number');
            $table->dropColumn('certificate_valid_until');
        });
    }
};
