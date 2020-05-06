<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Order extends Model
{
    protected $guarded = [];

    public function status()
    {
        return $this->belongsTo(Orderstatus::class,'orderstatus_id')->withTrashed();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function cartitems()
    {
        return $this->hasOne('App\Shoppingcart', 'identifier');
    }

    public function getOrderInfosAttribute()
    {
        return json_decode($this->attributes['order_infos']);
    }
}
