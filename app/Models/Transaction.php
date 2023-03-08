<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['amount','details','promo_code','commission','transaction_ref','user_id'];


    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function affiliateUser(){
        return $this->belongsTo(Affiliate::class,'promo_code','promo_code');
    }
}
