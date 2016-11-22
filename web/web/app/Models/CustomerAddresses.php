<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerAddresses extends Model
{
    protected $table = 'customer_addresses';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
}
