<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderStatus extends Model
{
    protected $table = 'order_status';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
}
