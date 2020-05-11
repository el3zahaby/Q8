<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\StatisticController;
use App\Order;
use App\OrderStatus;
use Dompdf\Dompdf;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class OrdersController extends Controller
{
    protected $view  = 'dash.orders.';
    protected $model = 'App\Order';

    public function __construct(){
//        $this->view = ;
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $items = $this->model::orderBy('id','desc')->get();
        $status = OrderStatus::all();
        return view($this->view.'index',compact('items','status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'design_id' => 'required',
            'tsize_id' => 'required',
            'tshirt_id' => 'required',
            'dsize_id' => 'required',
        ]);

        $order = new $this->model;
        $order->orderstatus_id = 1;

        $user = auth()->user();

        $design = \App\Design::find($request->design_id);

        $tshirt = \App\Tshirt::find($request->tshirt_id);

        $front_design_size = \App\DesignSize::where(['design_id' => $request->design_id , 'dsize_id' => $request->front])->get();

        $back_design_size = \App\DesignSize::where(['design_id' => $request->design_id , 'dsize_id' => $request->back])->get();


/*
        if ($store) return response()->json([
            'status'=>'ok',
            'msg'=>'Added'.$store->id
        ],200);
*/
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return View
     */
    public function show($id)
    {
        $item =  $this->model::findOrFail($id);
        return view($this->view.'show',compact('item'));
    }

    public function showByStatus($id)
    {
        $items =  OrderStatus::findOrFail($id)->orders;
        $status = OrderStatus::all();
        return view($this->view.'index',compact('items','status'));
    }

//    /**
//     * Show the form for editing the specified resource.
//     *
//     * @param int $id
//     * @return void
//     */
//    public function edit($id)
//    {
//        //
//    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     * @throws ValidationException
     */
    public function update(Request $request, $id)
    {
        $item = $this->model::find($id);

        $this->validate($request, [
            'length' => 'required|max:255',
            'width' => 'required|max:255',
            'print_price' => 'required|max:60',
        ]);

//        dd($request->all());
        $updated = $item->update($request->all());

        if ($updated) return response()->json([
            'status'=>'ok',
            'msg'=>'Updated'.$id
        ],200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
            $i = $this->model::findOrFail($id);
            $i->delete();
            return response()->json([
                'status'=>'ok',
                'msg'=>'deleted'.$id
            ],200);
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
        $total = StatisticController::calcTotalOfCartItem($cartItems);

        $view = view('reports.bill', compact('id', 'order', 'cartItems', 'total'));

        $pdf = new Dompdf(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
        $pdf->setBasePath(public_path());
        $pdf->loadHtml($view);
//        $pdf->setPaper('A4', 'landscape');
        $pdf->render();
        $pdf->stream("main-report.pdf", array("Attachment" => false));

        return $view;
    }

    public function changeStatus($id,Request $request){
        $order = Order::with('user')->find($id);
        $order->orderstatus_id = $request->status;
        $order->save();
        return redirect()->back();
    }
}
