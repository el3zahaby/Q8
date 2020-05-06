<?php

namespace App;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Database\Eloquent\Model;


class Order extends Model
{
    protected $guarded = [];

    protected $appends = ['items'];
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
    public function getCartTotalAttribute()
    {
        $id = $this->attributes['id'];

        $userCartIdentifier = 'USER-' . auth()->id();
        //Save User Cart
        try {
            Cart::store($userCartIdentifier);
        } catch (\Exception $ex) {
        } finally {
            Cart::destroy();
        }

        Cart::restore($id);
        $cartItems = Cart::total();
        Cart::store($id);
        Cart::destroy();

        //Restore User Cart
        Cart::restore($userCartIdentifier);

        return $cartItems;
    }
    public function getItemsAttribute()
    {
        $id = $this->attributes['id'];
        $cartItems = [];

        $userCartIdentifier = 'USER-' . auth()->id();
        //Save User Cart
        try {
            Cart::store($userCartIdentifier);
        } catch (\Exception $ex) {
        } finally {
            Cart::destroy();
        }

        Cart::restore($id);
        $cartItems = Cart::content()->all();
        Cart::store($id);
        Cart::destroy();

        //Restore User Cart
        Cart::restore($userCartIdentifier);

        return $cartItems;
    }

    public function getShippingInfoAttribute()
    {
        return json_decode($this->attributes['shipping_info']);
    }
}
