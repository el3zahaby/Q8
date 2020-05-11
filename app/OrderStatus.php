<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class OrderStatus extends Model{
    use SoftDeletes;

    protected $table = 'orderstatuses';

    public function orders()
    {
        return $this->hasMany(Order::class,'orderstatus_id');
    }
}
