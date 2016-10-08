<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Area extends Model
{
    protected $table = 'area';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

}
