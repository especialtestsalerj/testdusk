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
        // Update rows with null old_id
        $visitors = DB::table('visitors')
            ->whereNull('old_id')
            ->get();

        foreach ($visitors as $visitor) {
            $latestUpdatedAt = DB::table('visitors')
                ->where('old_id', $visitor->id)
                ->orWhere('id', $visitor->id)
                ->max('updated_at');

            $earliestCreatedAt = DB::table('visitors')
                ->where('old_id', $visitor->id)
                ->orWhere('id', $visitor->id)
                ->min('created_at');

            DB::table('visitors')
                ->where('id', $visitor->id)
                ->update([
                    'updated_at' => $latestUpdatedAt,
                    'created_at' => $earliestCreatedAt,
                ]);
        }

        DB::table('visitors')
            ->whereNotNull('old_id')
            ->get()
            ->each(function ($row) {
                DB::table('cautions')
                    ->where('visitor_id', $row->id)
                    ->update(['visitor_id' => $row->old_id]);
            });

        // Delete rows with non-null old_id
        DB::table('visitors')
            ->whereNotNull('old_id')
            ->delete();

        // Remove the old_id column from the visitors table
        Schema::table('visitors', function (Blueprint $table) {
            $table->dropColumn('old_id');
        });

        Schema::table('cautions', function (Blueprint $table) {
            $table->dropColumn('visitor_old_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Add the old_id column back to the visitors table
        Schema::table('visitors', function (Blueprint $table) {
            $table->unsignedBigInteger('old_id')->nullable();
        });

        Schema::table('cautions', function (Blueprint $table) {
            $table->unsignedBigInteger('visitor_old_id')->nullable();
        });
    }
};
