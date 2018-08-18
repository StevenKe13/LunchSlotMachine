<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lunch extends Model
{
    protected $table = 'lunch';

    protected $primaryKey = 'id';

    protected $fillable = [
        "store_name",
        "address",
        "status"
    ];
}
