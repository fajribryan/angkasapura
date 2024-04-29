<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class registercontroller extends Controller
{
    public function index(){
        return view ('/admin/login/register', [
            'title' => 'Register'
        ]);
    }
    public function store(Request $request){
        
        
        $validateData = Validator::make($request->all(),[
            'nama' => 'required|max:50',
            'username' => 'required|max:50',
            'password' => 'required',
        ]);

        if ($validateData->fails()) {
            return redirect('/registration-form')
                ->withErrors($validateData)
                ->withInput();
        }
        $userData = $request->all();
        $userData['level'] = 1;


        User::create($request->all());
        


        return redirect('/login')->with('success','Registrasi Berhasil! Silahkan Login');
    }
}
