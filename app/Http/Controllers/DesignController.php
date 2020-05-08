<?php

namespace App\Http\Controllers;

use App\Design;
use App\DesignsCollections;
use App\Dsize;
use App\Http\Controllers\Admin\DCollectionsController;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DesignController extends Controller
{
    public function show()
    {
        return DesignsCollections::inRandomOrder()->where('deleted_at', NULL)->paginate(8);
    }

    public function showBestSaller()
    {
        return Design::where('accepting', 1)->orderBy('created_at', 'desc')->take(4)->get();
    }

    public function showWithId($id)
    {
        return Design::where('accepting', 1)->where('id', $id)->with('colors')->first();
    }

    public function showByDesignerid()
    {
        $designer_id = auth()->id();
        return Design::where('user_id' , $designer_id)->get();
    }

    public function designSizes()
    {
        $sizes = \App\Dsize::get()->toArray();
        return $sizes;
    }

    public function latestDesignsByDesignerid()
    {
        $designer_id = auth()->id();
        return Design::where('user_id', $designer_id)->orderBy('created_at', 'desc')->take(4)->get();
    }

    public function getByRandId($id)
    {
        if (empty($id)) return Design::get();
        return Design::where('id','LIKE', '%'.$id.'%')->get();
    }

    public function creat(Request $request)
    {
        $this->validate($request,[
            'name_en' => 'required',
            'desc_en' => 'required',

            'name_ar' => 'required',
            'desc_ar' => 'required',

            'dsizes' => 'check_array:1',
        ]);

        $designer_id = auth()->id();
        $design = new Design();
        $design->user_id = auth()->user()->id;
        $design->img = $request->img;
        // $design->price = $request->price;
        $design->name_en = $request->name_en;
        $design->name_ar = $request->name_ar;
        $design->desc_en = $request->desc_en;
        $design->desc_ar = $request->desc_ar;
        $design->accepting = 0;


        // $request->dsizes
        $dsignsize = [];
        $i = -1;
        foreach($request->dsizes as $key => $price)
        {
            if($price != null and $price != 0 )
            {
                $dsignsize[$i]['dsize_id'] = $key;
                $dsignsize[$i]['designer_price'] = $price + 0;
                $dsignsize[$i]['total'] = Dsize::find($key)->print_price+$dsignsize[$i]['designer_price'];
            }else{
                // $store->delete();
            }
            $i++;

        }
        $design->designer_price = json_encode(array_values($dsignsize));

        $design->save();


        return $this->showByDesignerid();

    }

    public function uploadImage()
    {
        request()->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $imageName = time() . '.' . request()->image->getClientOriginalExtension();
        $directory = storage_path('app/public/uploads/designs');
        $url = request()->image->move($directory, $imageName);
        return '/storage/uploads/designs/' . $imageName;
    }

    public function delete($id)
    {
        $design = Design::find($id);
        $design->delete();
        return $this->showByDesignerid();
    }

    public function update(Request $request)
    {
        $id = 0;//Todo:Delete If No Need
        $design = Design::find($id);
        $design->img = $request->img;
        $design->price = $request->price;
        $design->save();

        return $this->show();
    }

}
