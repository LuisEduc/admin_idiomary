<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pregunta extends Model
{
    use HasFactory;

    protected $fillable = [ 'id_lesson','id_pregunta','pregunta', 'opcion1', 'opcion2','opcion3','respuesta' ];

    protected $hidden = ['created_at', 'updated_at'];

    public function lessons(){
        return $this->belongsTo(Lesson::class, 'id_lesson');
    }

}
