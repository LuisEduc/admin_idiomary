<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLessonimagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lessonimages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_lesson')
            ->nullable()
            ->constrained('lessons')
            ->cascadeOnUpdate()
            ->cascadeOnDelete();
            $table->integer('id_imagen')->nullable();
            $table->string('imagen')->nullable();
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
        Schema::dropIfExists('lessonimages');
    }
}
