<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::update(
            'INSERT INTO people (id, full_name, country_id, created_by_id, updated_by_id, created_at, updated_at)
                   SELECT id, full_name, 1, created_by_id, updated_by_id, created_at, updated_at FROM people2 ORDER BY id'
        );

        DB::update(
            'INSERT INTO documents (person_id, document_type_id, number, created_by_id, updated_by_id, created_at, updated_at)
                   SELECT id, 1, cpf, created_by_id, updated_by_id, created_at, updated_at FROM people2 ORDER BY id'
        );

        DB::update(
            'INSERT INTO documents (person_id, document_type_id, number, created_by_id, updated_by_id, created_at, updated_at)
                   SELECT id, 2, id_card, created_by_id, updated_by_id, created_at, updated_at FROM people2 WHERE id_card IS NOT NULL ORDER BY id'
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::update('DELETE FROM documents WHERE person_id IN (SELECT id FROM people2)');

        DB::update('DELETE FROM people WHERE id IN (SELECT id FROM people2)');
    }
};
