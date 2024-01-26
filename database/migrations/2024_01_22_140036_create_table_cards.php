<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Ramsey\Uuid\Uuid;
use App\Models\Card;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cards', function (Blueprint $table) {
            $table->id();

            $table->boolean('status')->default(true);
            $table->boolean('is_anonymous')->default(false);
            $table->uuid();
            $table->string('number')->unique();

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

        Schema::table('visitors', function (Blueprint $table) {
            $table->unsignedInteger('card_id')->nullable();

            $table
                ->foreign('card_id')
                ->references('id')
                ->on('cards');
        });

        for ($i = 1; $i <= 5000; $i++) {
            $card = new Card();
            $card->number = 'A' . str_pad($i, 4, '0', STR_PAD_LEFT);
            $card->uuid = Uuid::uuid4();
            $card->status = true;
            $card->is_anonymous = false;

            $card->save();
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
            $table->dropcolumn('card_id');
        });

        Schema::dropIfExists('cards');
    }
};
