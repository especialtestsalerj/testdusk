<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    protected function fixTable($tableName, $newPeopleTableName)
    {
        $oldPersonIds = DB::select(
            "select {$tableName}.id, {$tableName}.person_id from {$tableName}"
        );

        Schema::table($tableName, function (Blueprint $table) use (
            $tableName,
            $newPeopleTableName
        ) {
            $table->dropForeign($tableName . '_person_id_foreign');
            $table
                ->foreign('person_id')
                ->references('id')
                ->on($newPeopleTableName);
        });

        collect($oldPersonIds)->each(function ($item) {
            dump('id=' . $item->id . ' - person_id=' . $item->person_id);
            //            DB::table('visitors')
            //                ->where('id', $item->id)
            //                ->update(['person_id' => $item->person_id]);
        });
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->fixTable('visitors', 'people');
        $this->fixTable('person_restrictions', 'people');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->fixTable('visitors', 'people2');
        $this->fixTable('person_restrictions', 'people2');
    }
};
