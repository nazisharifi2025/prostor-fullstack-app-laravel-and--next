<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class images extends Model
{
    /** @use HasFactory<\Database\Factories\ImagesFactory> */
    use HasFactory;
    protected $fillable = [
        "url",
        "imageable",
    ];
    public function imageable(){
        return $this->morphTo();
    }
}
