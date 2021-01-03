<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePacksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packs', function (Blueprint $table) {
            $table->id();
            $table->string('name', 30);
            $table->text('description');
            $table->smallInteger('position')->nullable();
            $table->tinyInteger('type');
            $table->double('price', 8, 2);
            $table->double('price_offer', 8, 2)->nullable();
            $table->date('date_offer')->nullable();
            $table->text('image_vertical');
            $table->text('image_horizontal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('packs');
    }
}
