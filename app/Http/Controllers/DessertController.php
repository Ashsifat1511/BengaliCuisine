<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use Illuminate\Http\Request;

class DessertController extends Controller
{
    public function index()
    {
        $dessertitems = Dish::where('category', 'Dessert')->get();

        return view('dessert.index', compact('dessertitems'));
    }

    public function create()
    {
        return view('dessert.create');
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
            $path = $image->storeAs('uploads/dishes', $filename, 'public');
            $dish->image = $filename;
            $dish->save();
        }

        $dish->save();

        return redirect()->route('dessert.index')->with('success', 'Dessert item added successfully');
    }

    public function show($id)
    {
        $item = Dish::findOrFail($id);

        return view('dessert.details', compact('item'));
    }

    public function search(Request $request) {
        $query = $request->input('query');
        $dessertitems = Dish::where('category', 'dessert')->where('name', 'like', "%$query%")->get();
        return view('dessert.search', compact('dessertitems'));
    }
}
