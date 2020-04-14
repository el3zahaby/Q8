<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class UserController extends Controller
{
    protected $view  = 'dash.user-pages.users.';
    protected $model = 'App\User';

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
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'age' => 'max:60',
            'email' => 'required|email|unique:users,email',
        ]);


        $store = $this->model::create(
            $request->except(['is_designer'])+ ['password'=> bcrypt('password')]
        );
        if (isset($request->is_designer)){
            $store->assignRole('designer');
        }else{
            $store->assignRole('user');
        }

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
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'age' => 'max:60',
            'email' => 'required|email|unique:users,email,'.$item->id.',id'
        ]);

//        dd($request->all());
        $updated = $item->update($request->except(['is_designer']));

        if (isset($request->is_designer)){
            $item->assignRole('designer');
        }else{
            $item->removeRole('designer');
        }


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
        $item = $this->model::findOrFail($id);
        if ($item->isAdmin()) {
            return response()->json([
                'status'=>'no',
                'msg'=>'Not Deleted'.$id
            ],400);
        }

        $item->delete();
        return response()->json([
            'status'=>'ok',
            'msg'=>'deleted'.$id
        ],200);
    }
}
