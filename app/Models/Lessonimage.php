<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lessonimage extends Model
{
    use HasFactory;

    protected $fillable = [ 'id_imagen', 'imagen' ];

    protected $hidden = ['created_at', 'updated_at'];

    public function lessons(){
        return $this->belongsTo(Lesson::class, 'id_lesson');
    }

}
