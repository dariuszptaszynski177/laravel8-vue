<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;

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

    public function send_categories(Request $request)
    {
        $categories = $request->categories;
        $product_id = 1;

        

        foreach($categories as $c)
        {
            $category = new Category;
            $category->category_id = $c;
            $category->product_id = $product_id;
            $category->save();
        }
    }
}
