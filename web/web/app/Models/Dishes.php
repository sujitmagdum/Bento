<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dishes extends Model
{
    protected $table = 'dishes';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
}
