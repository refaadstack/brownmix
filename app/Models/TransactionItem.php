<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\FuncCall;

class TransactionItem extends Model
{
    use HasFactory;

    protected $fillable =[
        'users_id',
        'products_id',
        'transactions_id',
    ];
    public function product(){
        return $this->hasOne(Product::class,'id','products_id');
    }
}
