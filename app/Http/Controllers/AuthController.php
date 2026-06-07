<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $request->validate([
            "email"=> "required|string|min:3",
            "password"=> "required|string|min:5"
        ]);
        $users = User::all();
        foreach($users as $user){
            if($user->email === $request->email && Hash::chacke($request->password === $user->password)){
                return response()->json([
                    "data"=> "this User Name is with name" . $user->name,
                ]);
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "email"=> "required|email",
            "password"=> "required|numeric|min:6"
        ]);
        $user = User::where('email' , $request->email)->first();
        if($user && Hash::check($request->password , $user->password)){
           $token = $user->createToken('auth_token')->plainTextToken;
              return response()->json([
            "Created Token "=> $token,
            "successs"=> true
        ]);
        } 
        return response()->json([
            "success"=> false
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
