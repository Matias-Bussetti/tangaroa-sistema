<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePresencialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presencials', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->date('fecha', 0);
            $table->time('hora_inicio', 0);
            $table->time('hora_fin', 0);
            $table->text('link')->nullable();
            $table->foreignId('pack_id');
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
        Schema::dropIfExists('presencials');
    }
}
