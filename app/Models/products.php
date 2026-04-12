<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    /** @use HasFactory<\Database\Factories\ProductsFactory> */
    use HasFactory;
    protected $fillable = [
        "name",
        "stock",
        "price"
    ];
    public function productDetails(){
        return $this->hasOne(productDetails::class);
    }
     public function cartItems(){
        return $this->hasMany(cartItem::class);    
    }
}
