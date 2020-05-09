<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderStatus;
use Dompdf\Dompdf;
use Exception;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;
use App\Mail\ShippingMail;

class OrderController extends Controller
{

    public function submitOrder(Request $request)
    {
        $clientInfo = $request->get('clientInfo');
        $clientInfo = json_encode($clientInfo);
        $default_status = OrderStatus::first();

        $order = Order::create([
            'user_id' => auth()->id(),
            'shipping_info' => $clientInfo,
            'orderstatus_id' => $default_status->id ?? 1,
        ]);
        if (Cart::count() <= 0)
            return null;
        Cart::store($order->id);
        Cart::destroy();

        Mail::to(auth()->user()->email )->send(new ShippingMail);

        return $order;

    }
    public static function getCartItemsByOrder($id)
    {
        $cartItems = [];

        $userCartIdentifier = 'USER-' . auth()->id();
        //Save User Cart
        try {
            Cart::store($userCartIdentifier);
        } catch (Exception $ex) {
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

    public function getBill($id)
    {
        $order = Order::with('user')->find($id);
        $cartItems = self::getCartItemsByOrder($id);
        $total = StatisticController::calcTotalOfCartItems($cartItems);
//        dd($cartItems);
        $view = view('reports.bill', compact('id', 'order', 'cartItems', 'total'));

        $pdf = new Dompdf();
        $pdf->setBasePath(public_path());
        $pdf->loadHtml($view);
//        $pdf->setPaper('A4', 'landscape');
        $pdf->render();
        $pdf->stream("main-report.pdf", array("Attachment" => false));

        return $view;
    }
}
