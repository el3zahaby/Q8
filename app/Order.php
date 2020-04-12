<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Order extends Model
{
    protected $guarded = [];

    public function status()
    {
        return $this->belongsTo(Orderstatus::class, 'order_status');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function cartitems()
    {
        return $this->hasOne('App\Shoppingcart', 'identifier');
    }
}
