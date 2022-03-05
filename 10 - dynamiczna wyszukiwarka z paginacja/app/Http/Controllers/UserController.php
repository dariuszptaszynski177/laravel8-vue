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

    public function users()
    {   
        return view('search');
    }

    public function search(Request $request)
    {
        if($request->keyword || $request->perPage)
        {
            $search=$request->keyword;
            $perPage = $request->perPage;
        
        
            $users = User::where('name', 'LIKE','%'.$search.'%')->paginate($perPage);
            return response()->json($users);
        }
        else
        {
            $users = User::paginate(1);
            return response()->json($users);
        }
        
    }

    public function user($id)
    {
        $user = User::find($id);
        return response()->json($user);
    }
}
