<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\Account;
use App\Models\Affiliate;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
   public function showRegistrationForm(Request $request){
    $affiliates = Affiliate::get();
     return view('pages.register',compact('affiliates'));
   }

   public function register(UserRequest $request){
    // dd($request->all());
    try{
        $user = User::create([
            'name'   => $request->input('name'),
            'email'   => $request->input('email'),
            'password'   => bcrypt($request->input('password')),
            'dob'   => $request->input('dob'),
            'promo_code' => $request->input('promo_code') ?? null,
          ]);
          $account = Account::create([
            'amount' => 0,
            'total_commissions' => 0,
            'userType' => 'user',
            'user_id' => $user->id,
          ]);

          return redirect()->route('showLoginForm')->with('success','Registration completed successfully');
    }catch(Exception $e){

    }


   }
}
