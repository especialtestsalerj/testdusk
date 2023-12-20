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
        DB::transaction(function () {
            Schema::table('buildings', function (Blueprint $table) {
                $table->index('slug');
            });
            Schema::table('cabinets', function (Blueprint $table) {
                $table->index('name');
                $table->index('status');
            });
            Schema::table('cautions', function (Blueprint $table) {
                $table->index('concluded_at');
                $table->index('old_id');
                $table->index('protocol_number');
                $table->index('routine_id');
                $table->index('started_at');
            });
            Schema::table('caution_weapons', function (Blueprint $table) {
                $table->index('building_id');
                $table->index('caution_id');
                $table->index('old_id');
            });
            Schema::table('certificate_types', function (Blueprint $table) {
                $table->index('name');
                $table->index('status');
            });
            Schema::table('cities', function (Blueprint $table) {
                $table->index('name');
                $table->index('status');
            });
            Schema::table('countries', function (Blueprint $table) {
                $table->index('name');
                $table->index('status');
            });
            Schema::table('disability_types', function (Blueprint $table) {
                $table->index('name');
                $table->index('status');
            });
            Schema::table('documents', function (Blueprint $table) {
                $table->index('number');
                $table->index(
                    ['document_type_id', 'number', 'state_id'],
                    'documents_document_index'
                );
                $table->index('person_id');
            });
            Schema::table('document_types', function (Blueprint $table) {
                $table->index('name');
                $table->index('status');
            });
            Schema::table('events', function (Blueprint $table) {
                $table->index('building_id');
                $table->index('occurred_at');
                $table->index('routine_id');
            });
            Schema::table('event_types', function (Blueprint $table) {
                $table->index('name');
                $table->index('status');
            });
            Schema::table('genders', function (Blueprint $table) {
                $table->index('name');
                $table->index('status');
            });
            Schema::table('people', function (Blueprint $table) {
                $table->index('social_name');
            });
            Schema::table('person_restrictions', function (Blueprint $table) {
                $table->index('building_id');
                $table->index('ended_at');
                $table->index('person_id');
                $table->index('started_at');
            });
            Schema::table('routines', function (Blueprint $table) {
                $table->index('building_id');
                $table->index('entranced_at');
                $table->index('status');
            });
            Schema::table('sectors', function (Blueprint $table) {
                $table->index('name');
                $table->index('status');
            });
            Schema::table('sector_visitor', function (Blueprint $table) {
                $table->index('sector_id');
                $table->index('visitor_id');
            });
            Schema::table('stuffs', function (Blueprint $table) {
                $table->index('building_id');
                $table->index('entranced_at');
                $table->index('routine_id');
            });
            Schema::table('visitors', function (Blueprint $table) {
                $table->index('building_id');
                $table->index('entranced_at');
                $table->index('exited_at');
                $table->index('person_id');
                $table->index('uuid');
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::transaction(function () {
            Schema::table('buildings', function (Blueprint $table) {
                $table->dropIndex(['slug']);
            });
            Schema::table('cabinets', function (Blueprint $table) {
                $table->dropIndex(['name']);
                $table->dropIndex(['status']);
            });
            Schema::table('cautions', function (Blueprint $table) {
                $table->dropIndex(['concluded_at']);
                $table->dropIndex(['old_id']);
                $table->dropIndex(['protocol_number']);
                $table->dropIndex(['routine_id']);
                $table->dropIndex(['started_at']);
            });
            Schema::table('caution_weapons', function (Blueprint $table) {
                $table->dropIndex(['building_id']);
                $table->dropIndex(['caution_id']);
                $table->dropIndex(['old_id']);
            });
            Schema::table('certificate_types', function (Blueprint $table) {
                $table->dropIndex(['name']);
                $table->dropIndex(['status']);
            });
            Schema::table('cities', function (Blueprint $table) {
                $table->dropIndex(['name']);
                $table->dropIndex(['status']);
            });
            Schema::table('countries', function (Blueprint $table) {
                $table->dropIndex(['name']);
                $table->dropIndex(['status']);
            });
            Schema::table('disability_types', function (Blueprint $table) {
                $table->dropIndex(['name']);
                $table->dropIndex(['status']);
            });
            Schema::table('documents', function (Blueprint $table) {
                $table->dropIndex(['number']);
                $table->dropIndex('documents_document_index');
                $table->dropIndex(['person_id']);
            });
            Schema::table('document_types', function (Blueprint $table) {
                $table->dropIndex(['name']);
                $table->dropIndex(['status']);
            });
            Schema::table('events', function (Blueprint $table) {
                $table->dropIndex(['building_id']);
                $table->dropIndex(['occurred_at']);
                $table->dropIndex(['routine_id']);
            });
            Schema::table('event_types', function (Blueprint $table) {
                $table->dropIndex(['name']);
                $table->dropIndex(['status']);
            });
            Schema::table('genders', function (Blueprint $table) {
                $table->dropIndex(['name']);
                $table->dropIndex(['status']);
            });
            Schema::table('people', function (Blueprint $table) {
                $table->dropIndex(['social_name']);
            });
            Schema::table('person_restrictions', function (Blueprint $table) {
                $table->dropIndex(['building_id']);
                $table->dropIndex(['ended_at']);
                $table->dropIndex(['person_id']);
                $table->dropIndex(['started_at']);
            });
            Schema::table('routines', function (Blueprint $table) {
                $table->dropIndex(['building_id']);
                $table->dropIndex(['entranced_at']);
                $table->dropIndex(['status']);
            });
            Schema::table('sectors', function (Blueprint $table) {
                $table->dropIndex(['name']);
                $table->dropIndex(['status']);
            });
            Schema::table('sector_visitor', function (Blueprint $table) {
                $table->dropIndex(['sector_id']);
                $table->dropIndex(['visitor_id']);
            });
            Schema::table('stuffs', function (Blueprint $table) {
                $table->dropIndex(['building_id']);
                $table->dropIndex(['entranced_at']);
                $table->dropIndex(['routine_id']);
            });
            Schema::table('visitors', function (Blueprint $table) {
                $table->dropIndex(['building_id']);
                $table->dropIndex(['entranced_at']);
                $table->dropIndex(['exited_at']);
                $table->dropIndex(['person_id']);
                $table->dropIndex(['uuid']);
            });
        });
    }
};
