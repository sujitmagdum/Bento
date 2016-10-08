<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerBalance extends Model
{
    protected $table = 'customer_balance';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
}
