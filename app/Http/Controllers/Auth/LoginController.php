<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;

class LoginController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest')->except(['logout']);
        $this->middleware('guest:admin')->except(['logout']);
        $this->middleware('guest:affiliate')->except(['logout']);
    }
    public function showLoginForm(){
        return view('pages.login');
    }

    public function login(LoginRequest $request){
        $guard = 'web';
        $redirectRoute = 'user.dashboard';

        $credentials  = [
            'email'    => $request->input('email'),
            'password' => $request->input('password')
        ];

        if ($request->type === 'admin') {
            $guard = 'admin';
            $redirectRoute = 'admin.dashboard';
        }

        elseif ( $request->type === 'affiliate') {
            $guard = 'affiliate';
            $redirectRoute = 'affiliate.dashboard';
        }

        if(auth()->guard($guard)->attempt($credentials)){
            return redirect()->route($redirectRoute);
        }

        return redirect()->back();
    }

    public function logout(Request $request){
        auth()->guard($request->guard)->logout();
        return redirect()->route('login');
    }
}
