<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Palabra extends Model
{
    use HasFactory;

    protected $fillable = [ 'p_es','p_in','t_es','t_in','f_es','f_in','nivel','grabar' ];

    protected $hidden = ['created_at', 'updated_at'];

}