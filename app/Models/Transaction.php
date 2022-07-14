<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable =[
        'users_id',
        'name',
        'email',
        'address',
        'phone',
        'courier',
        'province_destination',
        'city_destination',
        'ongkir',
        'payment',
        'payment_url',
        'total_price',
        'status',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id','id');
    }
    public function province(){
        return $this->hasOne(Province::class,'id','province_destination');
    }
    public function city(){
        return $this->hasOne(City::class,'city_id','city_destination');
    }

    public function transactionItem(){
        return $this->belongsTo(TransactionItem::class,'transacaction_id','id');
    }

}
