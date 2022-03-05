<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Producer;
use App\Models\ImageProduct;


class ProductsController extends Controller
{
    public function index(Request $request)
    {
        if($request->search || $request->perPage)
        {
            $search = $request->search;
            $perPage = $request->perPage;

            $products = Product::with('producer')->where('name', 'LIKE','%'.$search.'%')->paginate($perPage);

            return response()->json($products);
        }
        else
        {
        $products = Product::with('producer')->paginate(5);

        return response()->json($products);
        }
    }

    public function product_producer()
    {
        $producers = Producer::get();

        return response()->json($producers);
    }

    public function add(Request $request)
    {
        $name = $request->name;
        $description = $request->description;
        $price = $request->price;
        $producer = $request->producer;


        $photo_temp = $request->file('photo')->getClientOriginalName();
        $filename = pathinfo($photo_temp, PATHINFO_FILENAME);
        $extension = pathinfo($photo_temp, PATHINFO_EXTENSION);

        $photo=$filename.'_'.time().'.'.$extension;

        $path = $request->file('photo')->storeAs(('public/products'), $photo);


        $product = new Product;
        $product->name = $name;
        $product->description = $description;
        $product->price = $price;
        $product->producer_id = $producer;
        $product->photo = $photo;

        $product->save();

        

        if($request->file('gallery'))
        {
            $product_id = $product->id;

            $gallery_image_temp = $request->file('gallery')->getClientOriginalName();

            $filename_gallery = pathinfo($gallery_image_temp, PATHINFO_FILENAME);
            $extension_gallery = pathinfo($gallery_image_temp, PATHINFO_EXTENSION);

            $gallery_image=$filename_gallery.'_'.time().'.'.$extension_gallery;

            $path = $request->file('gallery')->storeAs(('public/gallery'), $gallery_image);

            $gallery = new ImageProduct;
            $gallery->product_id = $product_id;
            $gallery->photo = $gallery_image;

            $gallery->save();
        }

    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $product = Product::find($id);

        return response()->json($product);
    }

    public function gallery(Request $request)
    {
        $id = $request->id;
        $gallery = ImageProduct::where('product_id', '=', $id)->get();

        return response()->json($gallery);
    }

    public function image_delete(Request $request)
    {
        $id = $request->id;

        $delete_product = ImageProduct::where('id', '=', $id)->delete();
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $name = $request->name;
        $description = $request->description;
        $price = $request->price;
        $producer = $request->producer_id;
        //$photo = $request->photo;


        if($request->file('photo'))
        {
        $photo_temp = $request->file('photo')->getClientOriginalName();
        $filename = pathinfo($photo_temp, PATHINFO_FILENAME);
        $extension = pathinfo($photo_temp, PATHINFO_EXTENSION);

        $photo=$filename.'_'.time().'.'.$extension;

        $path = $request->file('photo')->storeAs(('public/products'), $photo);
        
        $update_product = Product::where('id', '=', $id)->update(['name'=>$name, 'description'=>$description, 'price'=>$price, 'producer_id'=>$producer, 'photo'=>$photo]);
        }
        else
        {
            $update_product = Product::where('id', '=', $id)->update(['name'=>$name, 'description'=>$description, 'price'=>$price, 'producer_id'=>$producer]);
        }

        if($request->file('gallery'))
        {
            $product_id = $id;
            
            $gallery_image_temp = $request->file('gallery')->getClientOriginalName();

            $filename_gallery = pathinfo($gallery_image_temp, PATHINFO_FILENAME);
            $extension_gallery = pathinfo($gallery_image_temp, PATHINFO_EXTENSION);

            $gallery_image=$filename_gallery.'_'.time().'.'.$extension_gallery;

            $path = $request->file('gallery')->storeAs(('public/gallery'), $gallery_image);

            $gallery = new ImageProduct;
            $gallery->product_id = $product_id;
            $gallery->photo = $gallery_image;

            $gallery->save();
        }


        
    }

    public function delete(Request $request)
    {
        $id = $request->id;

        $delete_product = Product::where('id', '=', $id)->delete();
    }
}
