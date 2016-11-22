<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    protected $table = 'city';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
}
