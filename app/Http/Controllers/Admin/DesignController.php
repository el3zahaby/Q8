<?php

namespace App\Http\Controllers\Admin;

use App\Design;
use App\Dsize;
use App\DesignSize;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class DesignController extends Controller
{
    protected $view  = 'dash.designs.';
    protected $model = 'App\Design';


    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $items = $this->model::orderBy('id','desc')->get();
        $sizes = Dsize::get();
        return view($this->view.'index',compact('items','sizes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {

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
        // return $request->all();
        $this->validate($request, [
            'name_en' => 'required|max:255',
            'name_ar' => 'required|max:255',
            'img' => 'required|image',
            'user_id' => 'required',
            'price' => 'check_array:1', // the array required and min 1 item
        ]);

        if($request->hasFile('img')) {
            $file =  $request->img;
            $filename = time().'.'.$file->getClientOriginalExtension();
            $directory = storage_path('app/public/uploads/designs');
            $file->move($directory, $filename);
            $img = '/storage/uploads/designs/'.$filename;
        }

        $store = new $this->model;
        $store->name_en = $request->name_en;
        $store->name_ar = $request->name_ar;
        $store->desc_en = $request->desc_en;
        $store->desc_ar = $request->desc_ar;
        $store->user_id = $request->user_id;
        $store->accepting = $request->accepting;
        $store->img = $img;
        $store->save();


        foreach($request->price as $key => $price)
        {
            if($price != null and $price != 0 )
            {
                $dsignsize = new DesignSize;
                $dsignsize->design_id = $store->id;
                $dsignsize->dsize_id = $key;
                $dsignsize->designer_price = $price ;
                $dsignsize->save();
            }
        }


        if ($store && $dsignsize) return response()->json([
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
        // return $request->all();
        $item = $this->model::find($id);

        $this->validate($request, [
            'name_en' => 'required|max:255',
            'name_ar' => 'required|max:255',
            'user_id' => 'required',
            'price' => 'check_array:1', // the array required and min 1 item
            'price.*' => 'min:1'
        ]);

        $img = $item->img;
        if($request->hasFile('img')) {
            unlink(public_path() . $img);
            $file =  $request->img;
            $filename = time().'.'.$file->getClientOriginalExtension();
            $directory = storage_path('app/public/uploads/designs');

            $file->move($directory, $filename);
            $img = '/storage/uploads/designs/'.$filename;
        }


        $item->name_en = $request->name_en;
        $item->name_ar = $request->name_ar;
        $item->desc_en = $request->desc_en;
        $item->desc_ar = $request->desc_ar;
        $item->user_id = $request->user_id;
        $item->accepting = $request->accepting ?? 0 ;
        $item->img = $img;
        $item->save();

        $oldsizes = $item->design_sizes;
        foreach($oldsizes as $oldsize)
        {
            $oldsize->delete();
        }

        foreach($request->price as $key => $price)
        {
            if($price != null and $price != 0)
            {
                $designsize = new DesignSize;
                $designsize->design_id = $item->id;
                $designsize->dsize_id = $key;
                $designsize->designer_price = $price ;
                $designsize->save();
            }
        }


        // $updated = $item->update($request->except(['img'])+ ['img'=>$img]);


        if ($item && $designsize) return response()->json([
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
        $item = $this->model::findOrFail($id);
        unlink( public_path('/') . $item->img);
        $design_sizes = DesignSize::where('design_id',$item->id)->get();
        foreach($design_sizes as $ds)
        {
            $ds->delete();
        }

        $item->delete();
        return response()->json([
            'status'=>'ok',
            'msg'=>'deleted'.$id
        ],200);
    }
}
