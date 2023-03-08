<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\Admin;
use App\Models\Affiliate;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        //create dummpy Admin
        Admin::create ( [
           'name' => 'admin',
           'email' => 'admin@gmail.com',
           'password' => bcrypt('123456')
        ]);

        $affiliate = Affiliate::create( [
            'name'  => 'affiliate',
            'email'  => 'affiliate@gmail.com',
            'password'  => bcrypt('123456'),
            'promo_code'  => Str::random(6),
            'type'  => 'affiliate',
            'parent_id' => 0
        ]);

        $affiliateAccount = Account::create([
            'amount' => 0,
            'total_commissions' => 0,
            'userType' => 'affiliate',
            'affiliate_id' => $affiliate->id,
        ]);

        $subAffiliateAccount = Affiliate::create( [
            'name'  => 'sub-affiliate' ,
            'email'  => 'sub-affiliate@gmail.com',
            'password'  => bcrypt('123456'),
            'promo_code'  => Str::random(6),
            'type'  => 'sub-affiliate',
            'parent_id' => $affiliate->id
        ]);

        $subAffiliateAccount = Account::create([
            'amount' => 0,
            'total_commissions' => 0,
            'userType' => 'sub-affiliate',
            'affiliate_id' => $subAffiliateAccount->id,
        ]);


        $user = User::create( [
            'name'   => 'user',
            'email'  => 'user@gmail.com',
            'email_verified_at' => now(),
            'dob' => now()->format('Y-m-d'),
            'promo_code'  => $subAffiliateAccount->promo_code,
            'password'          => bcrypt('123456'), // password
            'remember_token'    => Str::random(10),
        ]);

        $subAffiliateAccount = Account::create([
            'amount' => 0,
            'total_commissions' => 0,
            'userType' => 'user',
            'user_id' => $user->id,
        ]);

    }
}
