<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cart extends Model
{
    /** @use HasFactory<\Database\Factories\CartFactory> */
    use HasFactory;
    protected $fillable = [
        "cartItem_id",
        "user_id"
    ];
    public function cartItems(){
        return $this->belongsTo(cartItem::class , "cartItem;_id");    
    }
    public function users(){
        return $this->belongsTo(User::class , "user_id");
    }
        
}
