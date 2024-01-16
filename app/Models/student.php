<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;

class student extends Model
{
    use HasFactory;

    protected $table='student';
    protected $fillable=[
        'id','name','image','std','maths','science','history','english','total','percentage','result'
    ];
}
