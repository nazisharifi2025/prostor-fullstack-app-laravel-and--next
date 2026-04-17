<?php

namespace App\Http\Controllers;

use App\Http\Requests\productRequest;
use App\Http\Requests\updateproductRequest;
use App\Http\Resources\productResource;
use App\Models\images;
use App\Models\productDetails;
use App\Models\products;
use Illuminate\Http\Request;

class productsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = products::with(['productDetails' , 'images'])->paginate(5);
        return productResource::collection($product);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(productRequest $request)
    {
        try{
        $imagePath = null ;
        if($request->hasFile("img_url")){
            $imagePath = $request->file("img_url")->store("images" , "public");
        }
        $product = products::create([
            "name" => $request->name,
            "stock" => $request->stock,
            "price" => $request->price,
        ]);
        $product->save();
        $productDetails = productDetails::create([
            "brand" => $request->brand,
            "description" => $request->description,
            "category" => $request->category,
            "product_id" => $product->id,
        ]);
        $productDetails->save();
        $image = images::create([
            "img_url" => $imagePath,
            "imageable_id" => $product->id,
            "imageable_type" => products::class,
        ]);
        $image->save();
        return response()->json([
            "message" => "Product created successfully",
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
       $product = products::findOrFail($id);
       $product->update([
        "name"=> $request->name,
        "stock"=> $request->stock,
        "price"=> $request->price,
       ]);
         $product->save();
            $productDetails = productDetails::where("product_id" , $id)->first();
            $productDetails->update([
                "brand" => $request->brand,
                "description" => $request->description,
                "category" => $request->category,
            ]);
            $productDetails->save();
            $path = null;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
