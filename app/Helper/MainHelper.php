<?php
namespace App\Helper;

use App\Models\Account;
use App\Models\Affiliate;

class MainHelper {

    public static function getCommissionViaPromoCode($user,$amount){
        $promo_code = $user->promo_code ?? null;
        if (!$promo_code) {
            return 0;
        }
        $commission = 0;
        $commissionAmount = 0;
        //now get affiliate user
        $affilateUser  = Affiliate::where('promo_code',$promo_code)->first();

        //check affilate user type is sub-affilate or not
        if ($affilateUser->type  === 'affiliate' ){
          //then he will get 30% commission
          $commission =  $amount * ( 30 / 100 );
          self::updateCommissionAffiliateUser($affilateUser,$commission);
          return [
            'affiliate_user_id' => $affilateUser->id,
            'totalCommission' => $commission,
          ];
        }

        elseif ($affilateUser->type  === 'sub-affiliate' ){
            // dd($affilateUser);
            //then he will get 20% commission
            $commission =  $amount * ( 20 / 100 );
            self::updateCommissionAffiliateUser($affilateUser,$commission);

            $parentCommission = $amount * ( 10 / 100 ); //parent will get 10 % commission]
            $parentAffilateUser  = $affilateUser->parentAffilate;
            self::updateCommissionAffiliateUser($parentAffilateUser,$parentCommission);


            $totalCommission = $commission + $parentCommission;


           return [
            'affiliate_user_id' => $parentAffilateUser->id,
            'sub-affiliate_user_id' => $affilateUser->id,
            'parentCommission' => $parentCommission,
            'commission' => $commission,
            'totalCommission' => $totalCommission,
            'AffilatePercentage' => 10,
            'subAffiliatePercentage' => 20,
          ];

        }
    }


    private static function updateCommissionAffiliateUser($affilateUser,$commission){
        $account = Account::where('affiliate_id',$affilateUser->id)->first();
        if(!$account){
            return ;
        }

        $account->amount += $commission;
        $account->total_commissions += $commission;
        $account->save();
    }

    public static function updateUserAccount($user,$amount,$commission){
        $updateAccount = Account::where('user_id',$user->id)->first();
        $updateAccount->amount += $amount;
        $updateAccount->total_commissions += $commission;
        $updateAccount->save();
        return true;
    }
}
