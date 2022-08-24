<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->nullable();
            $table->integer('orden')->nullable();
            $table->string('titulo')->nullable();
            $table->string('titulo_seo')->nullable();
            $table->string('descripcion')->nullable();
            $table->string('contenido', 8000)->nullable();
            $table->integer('preguntas')->nullable();
            $table->foreignId('id_categoria')
            ->nullable()
            ->constrained('categorias')
            ->cascadeOnUpdate()
            ->nullOnDelete();
            $table->string('estado')->nullable(); // publica o privada
            // reciente, favorita o normal
            $table->foreignId('id_tipo')
            ->nullable()
            ->constrained('tipos')
            ->cascadeOnUpdate()
            ->nullOnDelete();
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
        Schema::dropIfExists('lessons');
    }
}
