<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupen extends Model
{
    protected $table = 'coupen';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
}
