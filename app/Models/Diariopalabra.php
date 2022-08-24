<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diariopalabra extends Model
{
    use HasFactory;

    protected $fillable = [ 'mes','orden','palabras_es','palabras_in','imagen','audio' ];

    protected $hidden = ['created_at', 'updated_at'];
    
}
