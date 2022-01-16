<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;

    protected $guarded =[];

    public function city()
    {
        return $this->hasMany(City::class,'province_id','id');
    }

    public function transaction(){
        return $this->hasMany(Category::class ,'province_destination', 'id');
    }
    
}
