<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pushuser extends Model
{
    use HasFactory;

    protected $fillable = [ 'device_id','device_token' ];

    protected $hidden = ['created_at', 'updated_at'];
}
