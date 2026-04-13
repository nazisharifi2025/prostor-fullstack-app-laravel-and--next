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
        return $this->hasOne(productDetails::class , 'product_id');
    }
     public function cartItems(){
        return $this->hasMany(cartItem::class , 'cartItem_id');    
    }
        public function reviews(){
            return $this->hasMany(reviews::class , 'review_id');    
        }
        public function images(){
            return $this->morphMany(images::class , "imageable");    
        }
}
