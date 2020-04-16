<?php

namespace App\Http\Controllers\Admin;

use App\Page;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Slider;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Illuminate\Support\Str;

class PageController extends Controller
{
    protected $view  = 'dash.pages.';
    protected $model = 'App\Page';

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
        $table = $this->model::where('slug', 'not like', "%-ar%")->orderBy('id','desc')->get();
        return view($this->view.'index',compact('items','table'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        return view($this->view.'create');
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
            'title_en' => 'required',
            'title_ar' => 'required',
            'excerpt' => 'required',
            'meta_keywords' => 'required',
            'meta_desc' => 'required',
            'status' => 'required',
        ]);

        // return $request;

        $page_en = new $this->model;
        $page_en->author_id = auth()->user()->id;
        $page_en->title = $request->title_en;
        $page_en->body = $request->body_en;
        $page_en->excerpt = $request->excerpt;
        $page_en->meta_keywords = $request->meta_keywords;
        $page_en->status = $request->status;
        $page_en->meta_description = $request->meta_desc;
        $page_en->slug = Str::slug($request->title_en).'-en' ;


        $page_ar = new $this->model;
        $page_ar->author_id = auth()->user()->id;
        $page_ar->title = $request->title_ar;
        $page_ar->body = $request->body_ar;
        $page_ar->excerpt = $request->excerpt;
        $page_ar->meta_keywords = $request->meta_keywords;
        $page_ar->status = $request->status;
        $page_ar->meta_description = $request->meta_desc;
        $page_ar->slug = Str::slug($request->title_ar).'-ar' ;
        


        if($request->hasFile('image'))
        {
            $filename = time().'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads/pages',$filename));
            $page_en->image = $filename;
            $page_ar->image = $filename;
        }

        $page_en->save();
        $page_ar->save();
        
        // return $page_en;


        if ( $page_en && $page_ar) return response()->json([
            'status'=>'ok',
            'msg'=>'Added'
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
        $item =  $this->model::where('slug', 'not like', "%-ar%")->findOrFail($id);
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
            'name' => 'required|max:255',
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
}
