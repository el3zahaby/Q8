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
use Intervention\Image\Facades\Image;

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
        $sizes = Dsize::withTrashed()->get();
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
            $Image = Image::make($file);


            $Image->resize(200, null, function ($constraint) {
                $constraint->aspectRatio();
            });

            $filename = time().'.'.$file->getClientOriginalExtension();
            $directory = ('app/public/uploads/designs/');

            $file->move(storage_path($directory), $filename);
            if (!is_dir(storage_path($directory.'/thump/'))) mkdir(storage_path($directory.'/thump/'));
            $Image->save(storage_path($directory.'/thump/'.$filename));

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


        $dsignsize = [];
        $i = -1;
        foreach($request->price as $key => $price)
        {
            $i++;
            if($price != null and $price != 0 )
            {
                $dsignsize[$i]['dsize_id'] = $key;
                $dsignsize[$i]['designer_price'] = $price + 0;
                $dsignsize[$i]['total'] = Dsize::find($key)->print_price+$dsignsize[$i]['designer_price'];
            }else{
               // $store->delete();
            }

        }
        $store->designer_price = json_encode($dsignsize);



        if ($store->save())  return response()->json([
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
        ]);

        $img = $item->img;
        if($request->hasFile('img')) {
            unlink(public_path() . $img);

            $file =  $request->img;
            $Image = Image::make($file);

            $Image->resize(200, null, function ($constraint) {
                $constraint->aspectRatio();
            });

            $filename = time().'.'.$file->getClientOriginalExtension();
            $directory = ('app/public/uploads/designs/');

            $file->move(storage_path($directory), $filename);
            if (!is_dir(storage_path($directory.'/thump/'))) mkdir(storage_path($directory.'/thump/'));
            $Image->save(storage_path($directory.'/thump/'.$filename));

            $img = '/storage/uploads/designs/'.$filename;
        }


        $item->name_en = $request->name_en;
        $item->name_ar = $request->name_ar;
        $item->desc_en = $request->desc_en;
        $item->desc_ar = $request->desc_ar;
        $item->user_id = $request->user_id;
        $item->accepting = $request->accepting ?? 0 ;
        $item->img = $img;




        $dsignsize = [];
        $i = -1;
        foreach($request->price as $key => $price)
        {
            $i++;
            if($price != null and $price != 0 )
            {
                $dsignsize[$i]['dsize_id'] = $key;
                $dsignsize[$i]['designer_price'] = $price + 0;
                $dsignsize[$i]['total'] = Dsize::find($key)->print_price+$dsignsize[$i]['designer_price'];
            }else{
                // $store->delete();
            }

        }
        $item->designer_price = json_encode($dsignsize);




        if ($item->save()) return response()->json([
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
        if (file_exists(public_path('/') . $item->img)) {
            unlink(public_path('/') . $item->img);
        }
        $design_sizes = DesignSize::withTrashed()->where('design_id',$item->id)->get();

        foreach($design_sizes as $ds)
        {
            $ds->delete();
        }
        if ($item->dcollections) {
            $item->dcollections->delete();
        }
        $item->delete();
        return response()->json([
            'status'=>'ok',
            'msg'=>'deleted'.$id
        ],200);
    }
}
