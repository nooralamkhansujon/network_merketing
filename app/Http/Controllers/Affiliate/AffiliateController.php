<?php

namespace App\Http\Controllers\Affiliate;

use App\Http\Controllers\Controller;
use App\Http\Requests\AffiliateRequest;
use App\Models\Account;
use App\Models\Affiliate;
use App\Models\Transaction;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AffiliateController extends Controller
{
    public function dashboard()
    {
        $affiliateUser = auth()->guard('affiliate')->user();

        $account = Account::where('affiliate_id',$affiliateUser->id)->first();

        // dd($affiliateUser->notifications[0]->);
        $transactions = Transaction::with('user')->where('promo_code',$affiliateUser->promo_code)->get();
        $TotalUser    = User::where('promo_code',$affiliateUser->promo_code)->count();

        $TotalSubAffiliate   = $affiliateUser->subAffiliates->count();
        return view('pages.affiliate.dashboard',compact('transactions','TotalUser','TotalSubAffiliate','account'));
    }

    public function subAffiliates(){
        $affiliateUser = auth()->guard('affiliate')->user();
        $subAffiliates = $affiliateUser->subAffiliates;
        return view('pages.affiliate.sub-affiliates.index',compact('subAffiliates'));
    }

    public function subAffiliateForm(){
        return view('pages.affiliate.sub-affiliates.create');
    }

    public function addNewSubAffiliateUser(AffiliateRequest $request){
        $affiliateUser = auth()->guard('affiliate')->user();
        if($affiliateUser->type !== 'affiliate'){
            return abort(403);
        }
        try{
            //store
            $affiliate = Affiliate::create([
                'name'     => $request->input('name'),
                'email'    => $request->input('email'),
                'password' => bcrypt($request->input('password')),
                'promo_code' => Str::random(6),
                'type'    => 'sub-affiliate',
                'parent_id' => $affiliateUser->id
            ]);

            $account = Account::create([
                'amount' => 0,
                'total_commissions' => 0,
                'userType' => 'sub-affiliate',
                'affiliate_id' => $affiliate->id,
              ]);

            return redirect()->route('admin.affiliates.index')->with('success','Sub Affiliate has been added Succesfully');

         }catch(Exception $e){
            return redirect()->back()->with('error',$e->getMessage());
         }

    }
}
