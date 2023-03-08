<?php

namespace App\Http\Controllers\User;

use App\Events\NewTransactionEvent;
use App\Helper\MainHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\TransactionRequest;
use App\Models\Account;
use App\Models\Affiliate;
use App\Models\Transaction;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function dashboard(Request $request)
    {  $user_id  = auth()->id();
       $transactions = Transaction::with('user')->where('user_id',$user_id)->get();
        return view('pages.user.dashboard',compact('transactions'));
    }

    public function transactionForm(){
        return view('pages.user.Account.add_amount');
    }
    public function transaction(TransactionRequest $request){
        $user = $request->user();
        $commission = MainHelper::getCommissionViaPromoCode($user,$request->amount);

       try{
           DB::beginTransaction();
           //store transaction
           $transaction = Transaction::create([
               'amount'    => $request->input('amount'),
               'details'    => $request->input('details') ?? "",
               'promo_code'         => $user->promo_code ,
               'commission'         => $commission['totalCommission'],
               'transaction_ref'    => Str::random(20),
               'user_id'  => $user->id
           ]);

           MainHelper::updateUserAccount($user,$request->input('amount'),$commission['totalCommission']);

           if(count($commission) === 7 ){
               event(new NewTransactionEvent($commission['affiliate_user_id'],$commission['parentCommission'],$commission['AffilatePercentage'],$user));

               event(new NewTransactionEvent($commission['sub-affiliate_user_id'],$commission['commission'],$commission['subAffiliatePercentage'],$user));
           }
           else{
               event(new NewTransactionEvent($commission['affiliate_user_id'],$commission['totalCommission'],30,$user));
           }
           DB::commit();
           return redirect()->route('user.transactions.index');

       }catch(Exception $e){
          DB::rollBack();
          return redirect()->back()->with('error',$e->getMessage());
       }

    }

    public function transactions(){
        $user        = User::with('account')->findOrFail(auth()->id());
        $transactions = Transaction::where('user_id',$user->id)->get();
        return view('pages.user.Account.transactions',compact('transactions','user'));
    }
}
