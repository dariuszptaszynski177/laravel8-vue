<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producer;

use Illuminate\Support\Str;

class ProducersController extends Controller
{
    //For Generating Unique Slug Our Custom function
    public function createSlug($title, $id = 0)
    {
        
        // Normalize the title
        $slug = Str::slug($title);
        // Get any that could possibly be related.
        // This cuts the queries down by doing it once.
        $allSlugs = $this->getRelatedSlugs($slug, $id);
        // If we haven't used it before then we are all good.
        if (! $allSlugs->contains('slug', $slug)){
            return $slug;
        }
        // Just append numbers like a savage until we find not used.
        for ($i = 1; $i <= 10; $i++) {
            $newSlug = $slug.'-'.$i;
            if (! $allSlugs->contains('slug', $newSlug)) {
                return $newSlug;
            }
        }
        throw new \Exception('Can not create a unique slug');
    }

    protected function getRelatedSlugs($slug, $id = 0)
    {
        return Producer::select('slug')->where('slug', 'like', $slug.'%')
        ->where('id', '<>', $id)
        ->get();
    }





    public function index(Request $request)
    {
        if($request->search || $request->perPage)
        {
            $search = $request->search;
            $perPage = $request->perPage;

            $producers = Producer::where('name','LIKE','%'.$search.'%')->paginate($perPage);

            return response()->json($producers);
        }
        else
        {
        $producers = Producer::paginate(1);

        return response()->json($producers);
        }
    }

    public function add(Request $request)
    {
        $name = $request->name;
        //$logo = $request->logo;


        $logo_temp = $request->file('logo')->getClientOriginalName();
        $filename = pathinfo($logo_temp, PATHINFO_FILENAME);
        $extension = pathinfo($logo_temp, PATHINFO_EXTENSION);

        $logo=$filename.'_'.time().'.'.$extension;

        $path = $request->file('logo')->storeAs(('public/producers'), $logo);

        //$logo = $request->file('logo')->getClientOriginalName();
        $slug = $this->createSlug($name);

        $producer = new Producer;
        $producer->name = $name;
        $producer->logo = $logo;
        $producer->slug = $slug;

        $producer->save();
    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $producer = Producer::find($id);

        return response()->json($producer);
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $name = $request->name;
        
        //$logo = $request->logo;
        
        if($request->file('logo'))
        {
        $logo_temp = $request->file('logo')->getClientOriginalName();
        $filename = pathinfo($logo_temp, PATHINFO_FILENAME);
        $extension = pathinfo($logo_temp, PATHINFO_EXTENSION);

        $logo=$filename.'_'.time().'.'.$extension;

        $path = $request->file('logo')->storeAs(('public/producers'), $logo);

        
            $update_producer = Producer::where('id', '=', $id)->update(['name'=>$name, 'logo'=>$logo]);
        }
        else
        {
            $update_producer = Producer::where('id', '=', $id)->update(['name'=>$name]);
        }
    }

    public function delete(Request $request)
    {
        $id = $request->id;

        $delete_producer = Producer::where('id', '=', $id)->delete();
    }
}
