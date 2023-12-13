<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Building;

return new class extends Migration {
    public $referenceTables = [
        'routines',
        'visitors',
        'sectors',
        'stuffs',
        'caution_weapons',
        'person_restrictions',
        'events',
    ];

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buildings', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->string('slug');

            $table
                ->bigInteger('created_by_id')
                ->unsigned()
                ->nullable();
            $table
                ->bigInteger('updated_by_id')
                ->unsigned()
                ->nullable();

            $table
                ->foreign('created_by_id')
                ->references('id')
                ->on('users');
            $table
                ->foreign('updated_by_id')
                ->references('id')
                ->on('users');

            // Add other columns as needed
            $table->timestamps();
        });

        login_as_system();

        $building = new Building(['name' => 'Edifício Lúcio Costa', 'slug' => 'lucio-costa']);
        $building->save();
        $lucioCostaId = $building->id;

        $building = new Building(['name' => 'Palácio Tiradentes', 'slug' => 'palacio-tiradentes']);
        $building->save();

        foreach ($this->referenceTables as $table) {
            Schema::table($table, function (Blueprint $table) use ($lucioCostaId) {
                $table
                    ->bigInteger('building_id')
                    ->unsigned()
                    ->nullable()
                    ->default($lucioCostaId);

                $table
                    ->foreign('building_id')
                    ->references('id')
                    ->on('buildings');
            });

            Schema::table($table, function (Blueprint $table) {
                $table
                    ->bigInteger('building_id')
                    ->default(null)
                    ->change();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        foreach ($this->referenceTables as $table) {
            Schema::table($table, function (Blueprint $table) {
                $table->dropColumn('building_id');
            });
        }

        Schema::dropIfExists('buildings');
    }
};
