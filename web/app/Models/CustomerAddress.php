<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerAddress extends Model
{
    protected $table = 'customer_address';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
}
