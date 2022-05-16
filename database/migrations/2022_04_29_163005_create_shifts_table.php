<?php

use App\Models\Shift;
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
        Schema::create('shifts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('status')->default(true);
            $table
                ->bigInteger('created_by_id')
                ->unsigned()
                ->nullable();
            $table
                ->bigInteger('updated_by_id')
                ->unsigned()
                ->nullable();
            $table->timestamps();
        });

        $rows = ['08:00 - 20:00', '20:00 - 08:00'];

        foreach ($rows as $name) {
            $row = new Shift();
            $row->name = $name;
            $row->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shifts');
    }
};
