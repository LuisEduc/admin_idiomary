<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiariopalabrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diariopalabras', function (Blueprint $table) {
            $table->id();
            $table->integer('mes')->nullable();
            $table->integer('orden')->nullable();
            $table->string('palabras_es')->nullable();
            $table->string('palabras_in')->nullable();
            $table->string('imagen')->nullable();
            $table->string('audio')->nullable();
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
        Schema::dropIfExists('diariopalabras');
    }
}
