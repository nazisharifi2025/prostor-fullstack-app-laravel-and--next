<?php

namespace App\Http\Controllers;

use App\Models\images;
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
        return response()->json([
            "data"=> $product,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $product = new products();
        $imagePath = null ;
        if($request->hasFile("image_url")){
            $imagePath = $request->file("image_url")->store("images" , "public");
        }
        $product->name = $request->name;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->save();
        $image = new images();
        $image->url = $imagePath;
        $image->imageable->id= $product->id;
        $image->imageable_type = products::class;
        $image->save();
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
