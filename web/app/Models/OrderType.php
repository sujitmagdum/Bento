<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderType extends Model
{
    protected $table = 'order_type';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
}
