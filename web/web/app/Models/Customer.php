<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    protected $table = 'customer';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
}
