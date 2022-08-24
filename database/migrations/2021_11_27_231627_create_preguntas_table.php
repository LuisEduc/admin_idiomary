<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreguntasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preguntas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_lesson')
            ->nullable()
            ->constrained('lessons')
            ->cascadeOnUpdate()
            ->cascadeOnDelete();
            $table->integer('id_pregunta')->nullable();
            $table->string('pregunta')->nullable();
            $table->string('opcion1')->nullable();
            $table->string('opcion2')->nullable();
            $table->string('opcion3')->nullable();
            $table->integer('respuesta')->nullable();
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
        Schema::dropIfExists('preguntas');
    }
}
