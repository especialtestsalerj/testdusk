<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\WeaponType;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weapon_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');

            $table->timestamps();
        });

        $rows = ['pistola', 'revolver', 'faca', 'fuzil'];

        foreach ($rows as $name) {
            //dump($name);

            $row = new WeaponType();
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
        Schema::dropIfExists('weapon_types');
    }
};
