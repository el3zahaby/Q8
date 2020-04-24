<?php

namespace App\Http\Controllers\Admin;

use App\Tshirt;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class TshirtController extends Controller
{
    protected $view  = 'dash.tshirts.';
    protected $model = 'App\Tshirt';

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
        $colors = \App\Color::get();
        $tsizes = \App\Tsize::get();
        return view($this->view.'index',compact('items','colors','tsizes'));
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
            'color_id' => 'required',
            'tsize_id' => 'required',
            'price' => 'required',
            'qty' => 'required',
        ]);

        
        
        // $store = $this->model::create(
        //     $request->all()
        // );

        $store = new $this->model;
        $store->color_id = $request->color_id;
        $store->tsize_id = $request->tsize_id;
        $store->price = $request->price;
        $store->qty = $request->qty;

        $store->save();



        if ($store) return response()->json([
            'status'=>'ok',
            'msg'=>'Added'.$store->id
        ],200);

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
            'color_id' => 'required',
            'tsize_id' => 'required',
            'price' => 'required',
            'qty' => 'required',
        ]);

//        dd($request->all());
        // $updated = $item->update($request->all());


        $updated = $this->model::findOrFail($id);
        $updated->color_id = $request->color_id;
        $updated->tsize_id = $request->tsize_id;
        $updated->price = $request->price;
        $updated->qty = $request->qty;

        $updated->save();

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
}
