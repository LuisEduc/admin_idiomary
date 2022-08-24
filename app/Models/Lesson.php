<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    
    protected $fillable = [ 'slug','orden','titulo','titulo_seo','descripcion','contenido','id_categoria','estado','id_tipo','audio','preguntas' ];

    protected $hidden = ['created_at', 'updated_at'];

    public function categorias(){
        return $this->belongsTo(Categoria::class, 'id_categoria');
    }

    public function tipos(){
        return $this->belongsTo(Tipo::class, 'id_tipo');
    }

    public function preguntas(){
        return $this->hasMany(Pregunta::class, 'id_lesson');
    }

    public function lessonimages(){
        return $this->hasMany(Lessonimage::class, 'id_lesson');
    }
}
