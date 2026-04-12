<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productDetails extends Model
{
    /** @use HasFactory<\Database\Factories\ProductDetailsFactory> */
    use HasFactory;
    protected $fillable = [
        "description",
        "product_id",
        "brand",
        "category"
    ];
    public function products(){
        return $this->belongsTo(products::class , "product_id");
    }
}
