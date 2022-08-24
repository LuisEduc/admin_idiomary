<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipo extends Model
{
    use HasFactory;

    protected $fillable = [ 'slug','orden','posicion','titulo','icono','color','bg','estado' ];

    protected $hidden = ['created_at', 'updated_at'];

    public function lessons(){
        return $this->hasMany(Tipo::class, 'id');
    }
}