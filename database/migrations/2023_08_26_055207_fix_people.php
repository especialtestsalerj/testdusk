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
        //droping people2
        DB::statement('DROP SEQUENCE IF EXISTS people_id_seq CASCADE');
        //DB::statement('DROP TABLE people2');

        //changing people
        DB::statement('ALTER SEQUENCE people_id_seq1 RENAME TO people_id_seq');

        DB::statement("SELECT setval('people_id_seq', (SELECT max(id) FROM people))");

        DB::statement("ALTER TABLE people ALTER COLUMN id SET DEFAULT nextval('people_id_seq')");

        Schema::table('people', function (Blueprint $table) {
            $table->dropColumn('id_card');
            $table->dropColumn('certificate_type');
            $table->dropColumn('certificate_number');
            $table->dropColumn('certificate_valid_until');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        /*Schema::create('people2', function (Blueprint $table) {
            $table->id();
            $table->char('cpf', 11);
            $table->string('full_name');
            $table->string('origin')->nullable();
            $table->string('id_card')->nullable();
            $table->string('certificate_type')->nullable(); // público / privado
            $table->string('certificate_number')->nullable();
            $table->date('certificate_valid_until')->nullable();
            $table->string('photo')->nullable();
            $table->text('alert_obs')->nullable();
            $table
                ->bigInteger('created_by_id')
                ->unsigned()
                ->nullable();
            $table
                ->bigInteger('updated_by_id')
                ->unsigned()
                ->nullable();
            $table->timestamps();
        });*/

        Schema::table('people', function (Blueprint $table) {
            $table->string('id_card')->nullable();
            $table->string('certificate_type')->nullable();
            $table->string('certificate_number')->nullable();
            $table->date('certificate_valid_until')->nullable();
        });

        DB::statement('CREATE SEQUENCE IF NOT EXISTS people_id_seq2');

        DB::statement("SELECT setval('people_id_seq2', (SELECT max(id) FROM people2))");

        DB::statement("ALTER TABLE people2 ALTER COLUMN id SET DEFAULT nextval('people_id_seq2')");
    }
};
