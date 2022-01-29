<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;
use Image;


class CategoryController extends Controller
{
    //used this for api method for react
    public function getCategories(){
        $categories = Category::all();

        $categoryArray = [];

        foreach($categories as $category){
            $subcategory = Subcategory::where('category_name', $category->category_name)->get();

            $item = [
                'category_name' => $category->category_name,
                'category_image' => $category->category_image,
                'subcategory' => $subcategory
            ];

            array_push($categoryArray, $item);
        }

        return response()->json($categoryArray);
    }

    //this is used for admin
    public function categories(){
        $categories = Category::paginate(10);
        return view('backend.category.allcategories', compact('categories'));
    }

    public function add_category(){
        return view('backend.category.addcategory');
    }

    public function store_category(Request $request){

        $validated = $request->validate([
            'category_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_name' => 'required|unique:categories',
        ]);

        $image = $request->file('category_image');
        $imageName = time().'.'.$image->getClientOriginalExtension();
        // Image::make($image)->resize(300, 300)->save(public_path('upload/category/'.$imageName));
        $imageurl = env('BASE_URL') .'/upload/category/'.$imageName;


        Category::create([
            'category_name' => $request->category_name,
            'category_image' => $imageurl
        ]);

        return redirect()->route('allCategory')->with('success', 'Category added successfully');
    }

    public function edit_category(Request $request){
        $category = Category::find($request->id);
        return view('backend.category.editcategory', compact('category'));
    }

    public function update_category(Request $request){
        $validated = $request->validate([
            'category_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_name' => 'required',
        ]);

        $category = Category::find($request->id);

        if($request->file('category_image')){
            $image = $request->file('category_image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            // Image::make($image)->resize(300, 300)->save(public_path('upload/category/'.$imageName));
            $imageurl = env('BASE_URL') . '/upload/category/'.$imageName;
        }
        else{
            $imageurl = $category->category_image;
        }

        $category->update([
            'category_name' => $request->category_name,
            'category_image' => $imageurl
        ]);

        return redirect()->route('allCategory')->with('success', 'Category updated successfully');
    }

    public function delete_category(Request $request){
        $category = Category::find($request->id)->delete();
        return redirect()->route('allCategory')->with('success', 'Category deleted successfully');
    }
}
