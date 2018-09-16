<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lunch extends Model
{
    protected $table = 'lunch';

    protected $primaryKey = 'id';

    protected $fillable = [
        'store_name',
        'address',
        'status',
        'tel',
        'menu'
    ];
}
