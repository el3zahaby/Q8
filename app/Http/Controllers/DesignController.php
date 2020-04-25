<?php

namespace App\Http\Controllers;

use App\Design;
use App\DesignsCollections;
use App\Http\Controllers\Admin\DCollectionsController;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DesignController extends Controller
{
    public function show()
    {
        return DesignsCollections::inRandomOrder()->paginate(8);
    }

    public function showBestSaller()
    {
        return Design::where('accepting', 1)->orderBy('created_at', 'desc')->take(4)->get();
    }

    public function showWithId($id)
    {
        return Design::where('accepting', 1)->where('id', $id)->with('colors')->with('dsizes')->first();
    }

    public function showByDesignerid()
    {
        $designer_id = auth()->id();
        return Design::where('user_id' , $designer_id)->with('design_sizes','dsizes')->get();
    }

    public function designSizes()
    {
        $sizes = \App\Dsize::get()->toArray();
        return $sizes;
    }

    public function latestDesignsByDesignerid()
    {
        $designer_id = auth()->id();
        return Design::where('user_id', $designer_id)->orderBy('created_at', 'desc')->take(4)->with('design_sizes','dsizes')->get();
    }

    public function getByRandId($id)
    {
        return Design::where('random_name','LIKE', '%'.$id.'%')->get();
    }

    public function creat(Request $request)
    {
        $this->validate($request,[
            'img' => 'required',
            'name_en' => 'required',
            'dsizes' => 'check_array:1',
        ]);

        // dd($request->all());
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

        $design->save();

        foreach($request->dsizes as $key=>$dsize)
        {
            if($dsize != null)
            {
                $size = new \App\DesignSize;
                $size->design_id = $design->id;
                $size->dsize_id = $key;
                $size->designer_price = $dsize;
                $size->save();
            }
        }



        return $this->show();

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
        $design->removed = true;
        $design->save();
        return $this->show();
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
