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
        Schema::table('visitors', function (Blueprint $table) {
            $table->unsignedInteger('document_id')->nullable();

            $table
                ->foreign('document_id')
                ->references('id')
                ->on('documents');
        });

        $joinQuery = DB::table('visitors')
            ->join('people', 'visitors.person_id', '=', 'people.id')
            ->join('documents', 'people.id', '=', 'documents.person_id')
            ->join('document_types', 'documents.document_type_id', '=', 'document_types.id')
            ->where('document_types.name', 'CPF')
            ->select(
                'visitors.id as visitor_id',
                'people.full_name',
                'documents.id as document_id',
                'document_types.id as document_type_id',
                'documents.number as document_number',
                'document_types.name as document_type'
            );

        foreach ($joinQuery->cursor() as $visitor) {
            DB::table('visitors')
                ->where('id', $visitor->visitor_id)
                ->update(['document_id' => $visitor->document_id]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('visitors', function (Blueprint $table) {
            $table->dropColumn('document_id');
        });
    }
};
