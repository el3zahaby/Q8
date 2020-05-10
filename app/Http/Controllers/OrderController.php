<?php

namespace App\Http\Controllers;

use App\Mail\OrderReceived;
use App\Order;
use App\OrderStatus;
use Dompdf\Dompdf;
use Exception;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\ShippingMail;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{

    public function submitOrder(Request $request)
    {
        $clientInfo = $request->get('clientInfo');

        Session::put('clientInfo', $clientInfo);

        $price = Cart::total();
        $orderId = md5(uniqid());
        if ($price > 0) {
            $body = array(
                'merchant_id' => upayments('merchant_id'),
                'username' => upayments('username'),
                'password' => upayments('password'),
                'api_key' => upayments('api_key'),
                'order_id' => time().$orderId,
                'total_price' => $price,
                'CurrencyCode' => upayments('CurrencyCode'),
                'success_url' => route('pay.success'),
                'error_url' => route('pay.success'),
                'test_mode' => upayments('test_mode'),
                'CstFName' => auth()->user()->name,
                'CstEmail' => auth()->user()->email,
                'CstMobile' => auth()->user()->phone,
                'payment_gateway' => upayments('payment_gateway'),
                'whitelabled' => upayments('whitelabled'),
                'ProductTitle' =>implode(', ',Cart::content()->pluck('name')->toArray()),
                'ProductName'=>json_encode(Cart::content()->pluck('name')->toArray()),
                'ProductQty'=>json_encode(Cart::content()->pluck('qty')->toArray()),
                'ProductPrice'=>json_encode(Cart::content()->pluck('price')->toArray()),
            );

            $client = new \GuzzleHttp\Client(['headers' => ['x-Authorization' => 'hWFfEkzkYE1X691J4qmcuZHAoet7Ds7ADhL']]);

            $r = $client->request('POST', upayments('api_url'), [
                'form_params' => $body
            ]);
            $res = json_decode($r->getBody()->getContents());
//            dd($res);
            if ($res->status = 'success') {
                if (isset($res->paymentURL)) {
                    return response()->json($res,200);
                } else {
                    return response()->json($res,400);
                }
            } else {
                return response()->json($res,400);
            }
        } else {
            return response()->json([
                'status'=>'success',
                'paymentURL' =>route('pay.success'). '?Result=CAPTURED&OrderID=free-'.substr(md5(uniqid(rand(1, 6))), 0, rand(15, 20))
            ],200);
        }

//        if (Cart::count() <= 0)
//            return null;
//
//        Cart::store($order->id);
//        Cart::destroy();
//
//        Mail::to(auth()->user()->email )->send(new ShippingMail);
//
//        return $order;

    }


    public function successPay(Request $request)
    {
        if ($request->Result == 'CAPTURED') {
            $cart = Cart::content();


            $clientInfo = Session::get('clientInfo');


            $default_status = OrderStatus::first();


            $order = Order::create([
                'user_id' => auth()->id(),
                'shipping_info' => json_encode($clientInfo),
                'orderstatus_id' => $default_status->id ?? 1,
            ]);

            if (Cart::count() <= 0) return redirect(url('/'));

            Cart::store($order->id);
            Cart::destroy();

            $order = Order::find(1);
            Mail::to(Auth::user()->email)->send(new OrderReceived([
                    'payment' => $order,
                    'items' => $order->items,
                    'user' => Auth::user()
                ]
            ));
            return view('payment', compact('order'))->with('status', "The purchase was made successfully")->with('alert', 'success');

        } else {
            return view('payment')->with('status', "The purchase was not successful")->with('alert', 'danger');
        }
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
