<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Affiliate extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'promo_code',
        'type', // affiliate,sub-affiliate
        'parent_id'
    ];

    public function account(){
      return $this->hasOne(Account::class,'affiliate_id','id');
    }

    public function userTransactions(){
        return $this->hasMany(Transaction::class,'promo_code','promo_code');
    }

    public function parentAffilate(){
        return $this->belongsTo(Affiliate::class,'parent_id','id');
    }

    public function subAffiliates(){
        return $this->hasMany(Affiliate::class,'parent_id','id');
    }
}
