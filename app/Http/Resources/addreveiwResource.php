<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class addreveiwResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "rating"=> $this->rating,
            "comment"=> $this->comment,
            "user_name"=>$this->users->name,
            "user_email"=>$this->users->email,
            "product_name"=> $this->products->name,
            "product_id"=> $this->product_id,
            "created_at"=> $this->created_at
        ];
    }
}
