<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $subcategories = Subcategory::paginate(10);
        return view('backend.subcategory.index', compact('subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::latest()->get();
        return view('backend.subcategory.add', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'category_name' => 'required',
            'subcategory_name' => 'required',
        ]);

        Subcategory::create($validated);
        return redirect()->back()->with('success', 'Subcategory added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function show(Subcategory $subcategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function edit(Subcategory $subcategory)
    {
        //
        $categories = Category::orderBy('category_name', 'asc')->get();
        $subcategory = Subcategory::find($subcategory->id);
        return view('backend.subcategory.edit', compact('subcategory', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        
        $validated = $request->validate([
            'category_name' => 'required',
            'subcategory_name' => 'required',
        ]);
        $subcategory = Subcategory::find($request->id);
        $subcategory->category_name = $request->category_name;
        $subcategory->subcategory_name = $request->subcategory_name;
        $subcategory->save();
        return redirect()->route('subcategory.index')->with('success', 'Subcategory updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        Subcategory::find($id)->delete();
        return redirect()->route('subcategory.index')->with('success', 'Subcategory deleted successfully');
    }
}
