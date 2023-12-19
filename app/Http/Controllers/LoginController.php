<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class LoginController extends Controller
{
    public function create(){
        return view('login.create');
    }
    public function store(){
       
        $cleanData = request()->validate([
         'email'=> ['required','email', Rule::exists('users','email')],
         'password'=> ['required']
        ],[
            'email.exists' =>'email does not exist'
        ]);

            if(auth()->attempt($cleanData)){
                return redirect('/')->with('message','welcome '.auth()->user()->name);
            }else{
                return redirect()->back()->withErrors([
                    'password' => 'your password is something wrong'
                ]);
            }
          
    }
}
