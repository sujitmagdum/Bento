<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DishTypes extends Model
{
    protected $table = 'dish_types';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
}
