<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\AmmunitionType;

class CreateAmmunitionTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ammunition_types', function (Blueprint $table) {
            $table->id();

            $table->string('name');

            $table->timestamps();
        });

        $rows = ['fuzil', 'faca', 'revolver', 'pistola'];

        foreach ($rows as $name) {
            dump($name);

            $row = new AmmunitionType();
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
        Schema::dropIfExists('ammunition_types');
    }
}
