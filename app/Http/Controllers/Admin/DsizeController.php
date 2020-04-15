<?php

namespace App\Http\Controllers\Admin;

use App\Dsize;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class DsizeController extends Controller
{
    protected $view  = 'dash.dsizes.';
    protected $model = 'App\Dsize';

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
        return view($this->view.'index',compact('items'));
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
            'length' => 'required|max:255',
            'width' => 'required|max:255',
            'print_price' => 'required|max:60',
        ]);


        $store = $this->model::create(
            $request->all()
        );

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
        //
            $i = $this->model::find($id);
            $i->delete();
            return response()->json([
                'status'=>'ok',
                'msg'=>'deleted'.$id
            ],200);

        //

        // $item = $this->model::findOrFail($id);
        // if ($item->isAdmin()) {
        //     return response()->json([
        //         'status'=>'no',
        //         'msg'=>'Not Deleted'.$id
        //     ],400);
        // }

        // $item->delete();
        // return response()->json([
        //     'status'=>'ok',
        //     'msg'=>'deleted'.$id
        // ],200);
    }
}
