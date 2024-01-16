<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class standard extends Model
{
    use HasFactory;
    protected $table='standard';
    protected $fillable=[
        'id','standard'
    ];
}
