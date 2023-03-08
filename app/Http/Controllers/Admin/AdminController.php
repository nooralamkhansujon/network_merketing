<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AffiliateRequest;
use App\Models\Account;
use App\Models\Affiliate;
use App\Models\Transaction;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function dashboard(){
        $transactions = Transaction::with('user')->get();
        $TotalUser              = User::count();
        $TotalAffiliateUser   = Affiliate::where('type','affiliate')->count();
        $TotalSubAffiliateUser = Affiliate::where('type','sub-affiliate')->count();

        return view('pages.admin.dashboard',compact('transactions','TotalAffiliateUser','TotalSubAffiliateUser','TotalUser'));
    }

    public function users(){
        $users = User::with('account')->get();
        return view('pages.admin.users.index',compact('users'));
    }


    public function transactionsViaUser(Request $request,$userId){
        $user        = User::with('account')->findOrFail($userId);
        $transactions = Transaction::where('user_id',$userId)->get();
        return view('pages.admin.users.transactionsViaUser',compact('transactions','user'));
    }

    public function transactions(){
        $transactions = Transaction::all();
        return view('pages.admin.users.transactions',compact('transactions'));
    }

    public function affiliates(){
        $affiliates  = Affiliate::with('account')->where('type','affiliate')->get();
        return view('pages.admin.affiliates.index',compact('affiliates'));
    }

    public function affiliateForm(){
        return view('pages.admin.affiliates.create');
    }

    public function addNewAffiliateUser(AffiliateRequest $request) {

         try  {
            DB::beginTransaction();
            //store
            $affiliate = Affiliate::create([
                'name'     => $request->input('name'),
                'email'    => $request->input('email'),
                'password' => bcrypt($request->input('password')),
                'promo_code' => Str::random(6),
                'type'   => 'affiliate',
            ]);

            $account = Account::create([
                'amount' => 0,
                'total_commissions' => 0,
                'userType' => 'affiliate',
                'affiliate_id' => $affiliate->id,
            ]);
            DB::commit();
            return redirect()->route('admin.affiliates.index')->with('success','Affiliate has been added Succesfully');

         }catch(Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error',$e->getMessage());
         }


    }
}
