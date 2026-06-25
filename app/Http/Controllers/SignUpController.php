<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class SignUpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $user = User::all();
       return response()->json([
        "data"=> $user
       ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "name"=> "required|string|min:3",
            "email"=> "required|string|min:5",
            "password"=> "required|string|min:6",
            "phone_number"=> "required|string",
        ]);
        try{
            $user = User::create([
                "name"=> $request->name,
                "email"=> $request->email,
                "password"=> bcrypt($request->password),
                "phone_number"=> $request->phone_number
            ]);
             $token = $user->createToken('user_token')->plainTextToken;
             return response()->json([
                "message" => $token,
                "status"=> true
             ]);
        }catch(Exception $error){
              return response()->json([
                "message" => "somting went",
                "status"=> false
             ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
         $user = User::findOrFail('$id')->first();
         return response()->json([
            "message"=> $user
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
