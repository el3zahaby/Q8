<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

use Illuminate\Support\Facades\Mail;
use App\Mail\DesignerMail;
use App\MoneyRequest;

class UserController extends Controller
{
    protected $view  = 'dash.user-pages.';
    protected $model = 'App\User';


    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $items = $this->model::whereHas("roles", function($q){ $q->where("name", '<>', "admin")->where('name','<>','designer'); })->orderBy('id','desc')->get();
        return view($this->view.'users.index',compact('items'));
    }

    public function designers(){
        $roles = Role::all();
        $items = $this->model::whereHas("roles", function($q){ $q->where("name", "designer"); })->orderBy('id','desc')->get();
        return view($this->view.'designers.index',compact('items','roles'));
    }

    public function designersWait(){
        $roles = Role::all();
        $items = $this->model::notHaveRole()->whereNotNull('IBAN_Bank')->whereNotNull('Bank_Name')->orderBy('id','desc')->get();
        return view($this->view.'designers.index',compact('items','roles'));
    }

    public function designerRequest()
    {
        $items = $this->model::whereHas("roles",function($q){ $q->where("name","designer"); })->where('settings','!=','null')->orderBy('id','desc')->get();
        return view($this->view.'designers.moneyrequest',compact('items'));
    }

    public function admins(){
        $items = $this->model::whereHas("roles", function($q){ $q->where("name", "admin"); })->orderBy('id','desc')->get();
        return view($this->view.'admins.index',compact('items'));
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
            $request->except(['is_designer','avatar'])+ ['password'=> bcrypt('password'),'avatar'=>$avatar]
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
        return view($this->view.'users.show',compact('item'));
    }
    public function verify($id){

        $item =  $this->model::findOrFail($id);
        $item->markEmailAsVerified();
        return redirect()->back();
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
        $updated = $item->update($request->except(['is_designer','avatar'])+ ['avatar'=>$avatar]);

        if (isset($request->is_designer)){
            $item->assignRole('designer');
            Mail::to($item->email)->send(new DesignerMail);
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
    public function updateRole(Request $request , $id)
    {
        $user = $this->model::find($id);
        $user->syncRoles($request->role);
        return redirect()->back();
    }
}
