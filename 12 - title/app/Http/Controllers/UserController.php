<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function users()
    {
        $users = User::get();
        return response()->json($users);
    }

    public function user($id)
    {
        $user = User::find($id);
        return response()->json($user);
    }
}
