<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;


class CategoryController extends Controller
{
    //
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
}
