<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;
    protected $fillable = ['amount','total_commissions','userType','user_id','affiliate_id'];
    //userType 'admin','affiliate','sub-affiliate','user'

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function affiliateUser(){
        return $this->belongsTo(Affiliate::class,'affiliate_id');
    }
}
