<?php

use App\Models\WeaponType;
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
        Schema::create('weapon_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('status')->default(true);
            $table->timestamps();
        });

        $rows = ['Pistola', 'Revólver', 'Faca / Objeto cortante', 'Fuzil'];

        foreach ($rows as $name) {
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
