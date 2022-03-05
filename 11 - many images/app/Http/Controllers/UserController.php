<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Image;
use App\Models\Test;

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

    public function images(Request $request)
    {
        $name = $request->name;
        $photo1 = $request->photo1->getClientOriginalName();
        $photo2 = $request->photo2->getClientOriginalName();
        
        $image = new Image;
        $image->name = $name;
        $image->photo1 = $photo1;
        $image->photo2 = $photo2;

        $image->save();

        //$id = Image::where('name', '=', $name)->pluck('id');
        $id = $image->id;

        $test = new Test;
        $test->photo = $photo2;
        $test->product_id = $id;

        $test->save();

    }
}
