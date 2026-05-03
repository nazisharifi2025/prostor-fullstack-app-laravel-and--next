<?php

namespace App\Http\Controllers;

use App\Http\Requests\productRequest;
use App\Http\Requests\updateproductRequest;
use App\Http\Resources\productResource;
use App\Models\images;
use App\Models\productDetails;
use App\Models\products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class productsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = products::with(['productDetails' , 'images'])->orderBy('created_at')->paginate(5);
        return productResource::collection($product);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(productRequest $request)
    {
        try{
        $product = products::create([
            "name" => $request->name,
            "stock" => $request->stock,
            "price" => $request->price,
        ]);
        $product->save();
        $product->productDetails()->create([
            "brand" => $request->brand,
            "description" => $request->description,
            "category" => $request->category,
        ]);
        $images = [];
        if($request->hasFile('image1')){
           $images[] = ["img_url" => $request->file('image1')->store('images','public')];
        }
        if($request->hasFile('image2')){
           $images[] = ["img_url" => $request->file('image2')->store('images','public')];
        }
        if(!empty($images)){
            $product->images()->createMany($images);
        }
        return response()->json([
            "message" => "Product created successfully",
            "image"=> $images,
            "product"=> $product
        ]);
        }catch(\Exception $e){
            return response()->json([
                "message" => "Product creation failed",
                "error" => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $products = products::findOrFail($id);
        return response()->json([
            "data"=> $products,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(updateproductRequest $request, string $id)
    {
       $product = products::with(['images' , 'productDetails'])->findOrFail($id);
       $product->update([
        "name"=> $request->name,
        "stock"=> $request->stock,
        "price"=> $request->price,
       ]);
            
            $product->productDetails()->update([
                "brand" => $request->brand,
                "description" => $request->description,
                "category" => $request->category,
            ]);
           $path1 = null ;
           $path2 = null ;
           if($request->hasFile('image1') && $request->hasFile('image2')){
            $path1 = $request->file('image1')->store('images' , 'public');
            $path2 = $request->file('image2')->store('images' , 'public');
           }
           foreach($product->images() as $image){
            if(Storage::disk("public")->exists($image->img_url)){
                Storage::disk('public')->delete($image->img_url);
            }
           }
           $product->load(['images' , 'productDetails']);
           $product->images()->delete();
            $product->images()->createMany([
                ["img_url" => $path1],
                ["img_url" => $path2],
            ]);
            
            return response()->json([
                "message" => "Product updated successfully",
            ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = products::findOrFail($id);
        $product->load(["images", "productDetails"]);
        $product->productDetails()->delete();
        foreach($product->images as $image){
            if(Storage::disk('public')->exists($image->img_url)){
                Storage::disk('public')->delete($image->img_url);
            }
        }
        $product->images()->delete();
        $product->delete();
        return response()->json([
            "massege"=> "product deleted successfully with id" . $product->id,
        ]);
        
    }
}
