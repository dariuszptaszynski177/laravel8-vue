<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    // public function index()
    // {
    //     $users = User::get();
    //         return response()->json($users);
    // }

    public function users(Request $request)
    {

       

        
            $search=$request->keyword;
        
        
            $users = User::where('name', 'LIKE','%'.$search.'%')->get();
            return response()->json($users);
        
    }

    public function user($id)
    {
        $user = User::find($id);
        return response()->json($user);
    }
}
