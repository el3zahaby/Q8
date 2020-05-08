<?php

namespace App\Http\Controllers;

use App\Design;
use App\DesignsCollections;
use App\Order;
use Exception;
use Gloudemans\Shoppingcart\Facades\Cart;

class StatisticController extends Controller
{
    public function designerStatistic()
    {
        $designer_id = auth()->id();
        $designs_num = Design::where('user_id', $designer_id)->where('accepting', 1)->count();
        $sells = $this->getCartSellingForDesigner($designer_id);
        $totalData = self::calcDesignerTotalOfCartItems($sells);
        $sales_num = $totalData['count'];
        $sales_price = $totalData['total']*$totalData['count'];

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
//                dd($cartItem->id);
                if ($design != null) {
                    $userId = $cartItem->options['product']['design']['user_id'];
                    if ($userId == $id)
                        $cartItems[] = $cartItem;

                }
            }
        }
        return $cartItems;
    }

    public static function calcTotalOfCartItemsForSite($cartItems)
    {
        $count = 0;
        $total = 0;

        foreach ($cartItems as $item) {
            foreach ($item as $cartItem){
                foreach ($cartItem->options['product']['design']['designer_price'] as $price) {
                    $total += ($price['dsize']['print_price']);
                }
                $count += $cartItem->qty;
            }
        }
        return [
            'total' => $total,
            'count' => $count,
        ];
    }

    public static function calcTotalOfCartItemsForDesigners($cartItems)
    {
        $count = 0;
        $total = 0;

        foreach ($cartItems as $item) {
            foreach ($item as $cartItem){
                foreach ($cartItem->options['product']['design']['designer_price'] as $price) {
                    $total += ($price['designer_price']);
                }
                $count += $cartItem->qty;
            }
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

        foreach ($cartItems as $item) {
            foreach ($item as $cartItem){
                foreach ($cartItem->options['product']['design']['designer_price'] as $price) {
                    $total += ($price['total']);
                }
                $count += $cartItem->qty;
            }
        }
        return [
            'total' => $total,
            'count' => $count,
        ];
    }
    public static function calcDesignerTotalOfCartItems($cartItems)
    {
        $count = 0;
        $total = 0;

        foreach ($cartItems as $cartItem) {
            foreach ($cartItem->options['product']['design']['designer_price'] as $price){
                $total +=($price['designer_price']);
            }
//            ($total*$cartItem->qty);
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
        $designs = Design::where('accepting', 1)->get();
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
