<?php

namespace App\Http\Controllers;

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
    protected $model = 'App\Page';

    public function index()
    {
        return $this->model::where('slug', 'not like', "%-ar%")->orderBy('id','desc')->get();
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
//            'title_ar' => 'required',
            'excerpt' => 'required',
            'meta_keywords' => 'required',
            'meta_desc' => 'required',
            'status' => 'required',
        ]);

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
        $page_ar->title = $request->title_ar ?? '';
        $page_ar->body = $request->body_ar;
        $page_ar->excerpt = $request->excerpt;
        $page_ar->meta_keywords = $request->meta_keywords;
        $page_ar->status = $request->status;
        $page_ar->meta_description = $request->meta_desc;
        $page_ar->slug = Str::slug($request->title_en).'-ar' ;



        if($request->hasFile('image'))
        {
            $file =  $request->image;
            $filename = time().'.'.$file->getClientOriginalExtension();
            $directory = storage_path('app/public/uploads/pages');

            $request->image->move($directory, $filename);

            $page_en->image = '/storage/uploads/pages/'.$filename;
            $page_ar->image = '/storage/uploads/pages/'.$filename;
        }

        $page_ar->save();
        $page_en->save();



        if ( $page_en && $page_ar) return response()->json([
            'status'=>'ok',
            'msg'=>'Added'
        ],200);

    }

    /**
     * Display the specified resource.
     *
     * @param $slug
     * @return View
     */
    public function show($slug)
    {
        return ($this->model::where('status','ACTIVE')->where('slug', $slug.'-en')->firstOrFail());
    }
}
