<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class userController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function getcurrentMonthUser(){
      $users =  User::whereDate('created_at' , "< ", now())->whereDate('created_at' , "> " ,Carbon::now()->subDays(30) )->count();
      return response()->json([
        "currentUser"=> $users,
      ]);
    }
    public function getPreviouMonthUser(){
        try{
      $users =  User::whereDate('created_at' , "< ", Carbon::now()->subDays(30))->whereDate('created_at' , "> " ,Carbon::now()->subDays(30) )->count();
      return response()->json([
        "previousUser"=> $users,
      ]);
        }catch(Exception $err){
            return response()->json([
            "previousUser"=> $err->getMessage()
            ]);
        }
    }
}
