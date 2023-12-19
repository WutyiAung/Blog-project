<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function destroy(){
        auth()->logout();
        return redirect('/')->with('message','Good Bye');
    }
}
