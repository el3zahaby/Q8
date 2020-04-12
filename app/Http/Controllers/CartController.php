<?php

namespace App\Http\Controllers;

use App\Color;
use App\Design;
use App\Dsize;
use App\Tsize;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{


    public function __construct()
    {

    }

    public function show()
    {
        return Cart::content();
    }

    public function creat($productId, Request $request)
    {
        $frontprint = $request->frontprint | $request->backprint ? $request->frontprint : self::getDefaultPrintPrice()->id;
        $tcolor = $request->tcolor ? $request->tcolor : self::getDefaultColor()->id;
        $tsize = $request->tsize ? $request->tsize : self::getDefaultTsizePrice()->id;
        $count = $request->count ? $request->count : 1;

        $pro = Design::find($productId);
        $pro_price = self::getProductPrice($request, $pro->price);
        $pro_price -= $pro->discount*$pro->price;
        Cart::add($productId, $pro->name, $count, $pro_price
            , 0 //Weight
            , [
                'random_name' => $pro->random_name,
                'img' => '/storage/'.$pro->img,
                'frontprint' => $frontprint,
                'backprint' => $request->backprint,
                'tcolor' => $tcolor,
                'tsize' => $tsize,
                'count' => $count,

            ]

        );
        return $this->show();
    }

    public function update($productId, $count)
    {
        if ($count > 0)
            Cart::update($productId, $count);
        else
            $this->delete($productId);

        return $this->show();
    }

    public function delete($productId)
    {
        Cart::remove($productId);
        return $this->show();
    }

    public function total()
    {
        return [
            "subtotal" => Cart::subtotal(),
            "tax" => Cart::tax(),
            "total" => Cart::total(),
        ];
    }

    public function getProductPrice($request, $product_price)
    {
        if ($request->frontprint | $request->backprint) {
            $frontprice = self::getPrintPrice($request->frontprint);
        } else {
            $frontprice = self::getDefaultPrintPrice()->print_price;
        }
        $backprice = self::getPrintPrice($request->backprint);
        $tsize = $request->tsize ? self::getTsizePrice($request->tsize) : self::getDefaultTsizePrice()->price;
        return $product_price + $frontprice + $backprice + $tsize;

    }

    public function getPrintPrice($id)
    {
        $printPrice = Dsize::find($id);
        return $printPrice ? $printPrice->print_price : 0;

    }

    public function getDefaultPrintPrice()
    {
        return Dsize::first();
    }

    public function getTsizePrice($id)
    {
        return Tsize::find($id)->price;
    }

    public function getDefaultTsizePrice()
    {
        return Tsize::first();
    }

    public function getDefaultColor()
    {
        return Color::first();
    }


}
