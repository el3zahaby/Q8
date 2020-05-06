<?php

namespace App\Http\Controllers;

use App\Color;
use App\Design;
use App\DesignsCollections;
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
        $count = $request->count ? (int)$request->count : 1;

        $collection = DesignsCollections::find($productId);
        $pro = $collection->design;
        $pro_price = self::getProductPrice($request);
//        $pro_price = $pro_price-$pro->descount;
        Cart::add($collection->design->id, $pro->name_en, $count, $pro_price
            , 0 //Weight
            , $request->all() // option
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
            "suptotal" => Cart::subtotal(),
            "tax" => Cart::tax(),
            "total" => Cart::total(),
        ];
    }

    public function getProductPrice($request)
    {
        $design =Design::find($request->id);
        $fp = 0;
        $bp = 0;
        $tshirtPrice = 0;
        $discount = 0 ;

        if ($request->frontprint){
            $fp =$request->frontprint = Dsize::find($request->frontprint['dsize_id'])->print_price+$design->dsize_price($request->frontprint['dsize_id']);
        }
        if ($request->backprint){
            $bp =$request->backprint = Dsize::find($request->backprint['dsize_id'])->print_price+
                $design->dsize_price($request->backprint['dsize_id']);
        }
        if ($design->discount > 0){
            $discount = $design->discount;
        }

        if ($request->tsize) $tshirtPrice = $request->tsize['price'];

        return (($fp+$bp)-$discount)+$tshirtPrice;
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
