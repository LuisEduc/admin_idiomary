<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePalabrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('palabras', function (Blueprint $table) {
            $table->id();
            $table->string('p_es')->nullable();
            $table->string('p_in')->nullable();
            $table->string('t_es')->nullable();
            $table->string('t_in')->nullable();
            $table->string('f_es')->nullable();
            $table->string('f_in')->nullable();
            $table->string('nivel')->nullable();
            $table->boolean('grabar')->nullable();
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
        Schema::dropIfExists('palabras');
    }
}
