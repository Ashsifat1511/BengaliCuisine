<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dish;

class VegController extends Controller
{
    public function index()
    {
        $vegitems = Dish::where('category', 'Veg')->get();

        return view('veg.index', compact('vegitems'));
    }

    public function create()
    {
        return view('veg.create');
    }

    public function store(Request $request)
    {
        $dish = new Dish();

        $validationRules =[
            'name' => 'required',
            'spices' => 'required',
            'category' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];

        $request->validate($validationRules);

        $dish->name = $request->input('name');
        $dish->spices = $request->input('spices');
        $dish->category = $request->input('category');
        $dish->description = $request->input('description');
        $dish->user_id = auth()->user()->id;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            // Specify the path within the public disk
            $path = $image->storeAs('uploads/dishes', $filename, 'public');
            $dish->image = $filename; // Save the full path or just the filename, as needed
            $dish->save();
        }

        $dish->save();

        return redirect()->route('veg.index')->with('success', 'Dish added successfully');
    }

    public function show($id)
    {
        $item = Dish::findOrFail($id);

        return view('veg.details', compact('item'));
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $vegitems = Dish::where('category', 'veg')->where('name', 'like', "%$search%")->get();

        return view('veg.search', compact('vegitems'));
    }

    
}
