<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeliveryPerson extends Model
{
    protected $table = 'delivery_person';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
}
