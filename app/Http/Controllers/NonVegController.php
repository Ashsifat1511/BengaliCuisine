<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dish;
use App\Models\User;

class NonVegController extends Controller
{
    public function index()
    {
        $nonvegitems = Dish::where('category', 'Non-Veg')->with('user')->get();

        return view('nonveg.index', compact('nonvegitems'));
    }

    public function create()
    {
        return view('nonveg.create');
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

        return redirect()->route('nonveg.index')->with('success', 'Non-Veg item added successfully');
    }

    public function show($id)
    {
        $item = Dish::findOrFail($id);

        return view('nonveg.details', compact('item'));
    }

    public function search(Request $request) {
        $query = $request->input('query');
        $nonvegitems = Dish::where('category', 'non-veg')->where('name', 'like', "%$query%")->get();
        return view('nonveg.search', compact('nonvegitems'));
    }

}
