<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CoupenPurchase extends Model
{
    protected $table = 'coupen_purchase';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
}
