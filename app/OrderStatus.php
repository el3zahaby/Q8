<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class OrderStatus extends Model{
    use SoftDeletes;

    protected $table = 'orderstatuses';

}
