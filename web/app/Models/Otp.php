<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Otp extends Model
{
    protected $table = 'otp';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

}
