<?php

namespace App\Http\Controllers\Admin;

use App\Tshirt;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class DCollectionsController extends Controller
{
    protected $view  = 'dash.dcollections.';
    protected $model = 'App\DesignsCollections';

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
        $designs = \App\Design::where('accepting',1)->get();
        $tshirts = \App\Tshirt::get();
        return view($this->view.'index',compact('items','tshirts','designs'));
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
            'tshirts' => 'required',
            'design_id' => 'required',
        ]);



        $store = new $this->model;
        $store->tshirt_id = json_encode($request->tshirts);
        $store->design_id = $request->design_id;
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
            'tshirts' => 'required',
            'design_id' => 'required',
        ]);



        $item->tshirt_id = json_encode($request->tshirts);
        $item->design_id = $request->design_id;
        $item->save();


        if ($item) return response()->json([
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
