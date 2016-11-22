<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Admin extends Model
{
    protected $table = 'admin';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

}
