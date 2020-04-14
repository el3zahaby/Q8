<?php

namespace App\Http\Controllers;

use App\Design;
use App\Order;
use Exception;
use Gloudemans\Shoppingcart\Facades\Cart;

class StatisticController extends Controller
{
    public function designerStatistic()
    {
        $designer_id = auth()->id();
        $designs_num = Design::where('designer_id', $designer_id)->where('removed', false)->count();
        $sells = $this->getCartSellingForDesigner($designer_id);
        $totalData = self::calcTotalOfCartItems($sells);
        $sales_num = $totalData['count'];
        $sales_price = $totalData['total'];

        // return response()->json([
        //     ['name' => 'Designs Number',
        //         'value' => $designs_num],
        //     ['name' => 'Sales Number',
        //         'value' => $sales_num],
        //     ['name' => 'Sales Price',
        //         'value' => '$' . $sales_price],
        // ]);
        return [$designs_num, $sales_num, $sales_price];
    }

    //Get Statistics
    public static function getCartSellingGeneral()
    {
        $userCartIdentifier = 'USER-' . auth()->id();
        //Save User Cart
        try {
            Cart::store($userCartIdentifier);
        } catch (Exception $ex) {
        } finally {
            Cart::destroy();
        }


        $orders = Order::all();
        $cart = [];
        foreach ($orders as $order) {
            Cart::restore($order->id);
            $cart[] = Cart::content();
            Cart::store($order->id);
            Cart::destroy();
        }

        //Restore User Cart
        Cart::restore($userCartIdentifier);

        return $cart;
    }

    public function getCartSellingForDesigner($id)
    {
        $cartItems = [];
        $allOrdersCartItems = self::getCartSellingGeneral();
        foreach ($allOrdersCartItems as $orderCartItems) {
            foreach ($orderCartItems as $cartItem) {
                $design = Design::find($cartItem->id);
                if ($design != null) {
                    $userId = $design->designer_id;
                    if ($userId == $id)
                        $cartItems[] = $cartItem;
                }
            }
        }
        return $cartItems;
    }

    public static function calcTotalOfCartItemsForAllUsers($cartItems)
    {
        $count = 0;
        $total = 0;
        foreach ($cartItems as $cartItem_collection) {
            $cartItem_collection_data = self::calcTotalOfCartItems($cartItem_collection->all());
            $count += $cartItem_collection_data['count'];
            $total += $cartItem_collection_data['total'];
        }
        return [
            'total' => $total,
            'count' => $count,
        ];
    }

    public static function calcTotalOfCartItems($cartItems)
    {
        $count = 0;
        $total = 0;

        foreach ($cartItems as $cartItem) {
            $total += $cartItem->subtotal + $cartItem->tax - $cartItem->discount;
            $count += $cartItem->qty;
        }
        return [
            'total' => $total,
            'count' => $count,
        ];
    }

    public function getMostSells()
    {
        $cartItemsCollections = self::getCartSellingGeneral();
        $designs = Design::where('accepting', 1)->where('removed', false)->get();
        foreach ($designs as $design) {
            $design['counter'] += $this->getDesignSelling($cartItemsCollections, $design);
        }
        return $designs->sortByDesc('counter')->slice(0,4)->all();
    }

    private function getDesignSelling($cartItemsCollections, Design $design)
    {
        $counter = 0;
        foreach ($cartItemsCollections as $cartItemsCollection) {
            $designInCollection = $cartItemsCollection->where('id', $design->id)->all();
            foreach ($designInCollection as $item) {
                $counter += $item->qty;
            }
        }
        return $counter;
    }
}
