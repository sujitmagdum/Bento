<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderSubType extends Model
{
    protected $table = 'order_sub_type';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
}
