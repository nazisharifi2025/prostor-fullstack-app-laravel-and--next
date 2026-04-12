<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cartItem extends Model
{
    /** @use HasFactory<\Database\Factories\CartItemFactory> */
    use HasFactory;
    protected $fillable = [
        "qty",
        "product_id",
        "price"
    ];
    public function products(){
        return $this->belongsTo(products::class , "product_id");    
    }
    public function carts(){
        return $this->hasMany(cart::class , "cartItem_id");    
    }
}
