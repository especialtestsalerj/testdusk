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
        dump('Criando a tabela sector_visitor');
        Schema::create('sector_visitor', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('visitor_id');
            $table->unsignedBigInteger('sector_id')->nullable();
            $table->timestamps();

            $table->foreign('visitor_id')->references('id')->on('visitors')->onDelete('cascade');
            $table->foreign('sector_id')->references('id')->on('sectors')->onDelete('cascade');
        });

        dump('migrando os ids para a nova tabela');
        $visitors= app(\App\Models\Visitor::class)->all();

        foreach($visitors as $visitor){
            dump('Visitor: '.$visitor->id. ' '.$visitor->sector_id);
            DB::insert('INSERT INTO sector_visitor (visitor_id, sector_id) values (?, ?)', [
                $visitor->id,
                $visitor->sector_id,
            ]);
        }

        Schema::table('visitors', function (Blueprint $table) {
            $table->dropColumn('sector_id');
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
            $table->integer('sector_id')->nullable();
        });
        DB::insert('UPDATE VISITORS SET SECTOR_ID =  (SELECT SECTOR_VISITOR.SECTOR_ID FROM SECTOR_VISITOR WHERE VISITORS.ID = SECTOR_VISITOR.VISITOR_ID)');

        Schema::dropIfExists('sector_visitor');
    }
};
