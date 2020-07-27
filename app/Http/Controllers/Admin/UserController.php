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
    protected $view  = 'admin.post.';
    protected $model = 'App\Post';


    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $items = $this->model::all();
        return view($this->view.'users.index',compact('items'));
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
            'avatar' => 'required|image',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|unique:users,phone',
        ]);


        $avatar = null;
        if($request->hasFile('avatar')) {
            $file =  $request->avatar;
            $filename = time().'.'.$file->getClientOriginalExtension();
            $directory = storage_path('app/public/uploads/users');

            $file->move($directory, $filename);
            $avatar = '/storage/uploads/users/'.$filename;
        }

        $store = $this->model::create(
            $request->except(['avatar'])+ ['avatar'=>$avatar]
        );

        if ($store) {
            return response()->json([
                'status' => 'ok',
                'msg' => 'Added' . $store->id
            ], 200);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return View
     */
    public function show($id)
    {
        $item = $this->model::findOrFail($id);
        return view($this->view . 'users.show', compact('item'));

    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return void
     */
    public function edit($id)
    {
        $item = $this->model::findOrFail($id);
        return view($this->view . 'users.show', compact('item'));
    }

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
            'email' => 'required|email|unique:users,email,'.$item->id.',id',
            'phone' => 'required|unique:users,phone,'.$item->id.',id',
        ]);

        $avatar = null;
        if($request->hasFile('avatar')) {
            $file =  $request->avatar;
            $filename = time().'.'.$file->getClientOriginalExtension();
            $directory = storage_path('app/public/uploads/users');

            $file->move($directory, $filename);
            $avatar = '/storage/uploads/users/'.$filename;
        }
        $updated = $item->update($request->except(['avatar'])+ ['avatar'=>$avatar]);




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

        $item->delete();
        return response()->json([
            'status'=>'ok',
            'msg'=>'deleted'.$id
        ],200);
    }
}
