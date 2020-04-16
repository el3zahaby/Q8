<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class FileController extends Controller{

    public function __construct(){
        $this->middleware('auth');
    }

    public function store(Request $request,$path,$inputName = null){
        $input = $request->all();


        $file = $request->file('file');

        $directory = storage_path('app/public/uploads/'.$path);



        $upload_success = $file->move($directory, $file->getClientOriginalName());


        dd($upload_success);
        if( $upload_success ) {
            return response()->json('success',200);
         } else {
            return response()->json('error',400);
        }

    }
}
