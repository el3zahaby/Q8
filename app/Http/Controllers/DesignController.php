<?php

namespace App\Http\Controllers;

use App\Design;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DesignController extends Controller
{
    public function show()
    {
        return Design::where('accepting', 1)->where('removed', false)->inRandomOrder()->paginate(8);
    }

    public function showBestSaller()
    {
        return Design::where('accepting', 1)->where('removed', false)->orderBy('created_at', 'desc')->take(4)->get();
    }

    public function showWithId($id)
    {
        return Design::where('accepting', 1)->where('removed', false)->where('id', $id)->with('colors')->with('dsizes')->first();
    }

    public function showByDesignerid()
    {
        $designer_id = auth()->id();
        return Design::where('designer_id', $designer_id)->where('removed', false)->get();
    }

    public function latestDesignsByDesignerid()
    {
        $designer_id = auth()->id();
        return Design::where('designer_id', $designer_id)->where('removed', false)->orderBy('created_at', 'desc')->take(4)->get();
    }

    public function getByRandId($id)
    {
        return Design::where('random_name','LIKE', '%'.$id.'%')->get();
    }

    public function creat(Request $request)
    {
        $designer_id = auth()->id();
        $design = new Design();
        $design->random_name = Str::random(10);
        $design->designer_id = $designer_id;
        $design->img = $request->img;
        $design->price = $request->price;
        $design->name = $request->name;

        $design->save();

        return $this->show();

    }

    public function uploadImage()
    {
        request()->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $imageName = time() . '.' . request()->image->getClientOriginalExtension();
        $url = request()->image->move(storage_path('app\public\designs'), $imageName);
        return 'designs\\' . $imageName;
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
