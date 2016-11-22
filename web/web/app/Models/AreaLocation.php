<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AreaLocation extends Model
{
    protected $table = 'area_location';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
}
