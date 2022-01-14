<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\ProductList;

class ProductListController extends Controller
{
    //
    public function getProductListByRemark(Request $request)
    {
        $remark = $request->remark;
        $productList = ProductList::where('remark', $remark)->limit(6)->get();
        return response()->json($productList);
    }

    public function getProductListByCategory(Request $request)
    {
        $category = $request->category;
        $productList = ProductList::where('category', $category)->get();
        return response()->json($productList);
    }

    public function getProductListBySubategory(Request $request){
        $category = $request->category;
        $subcategory = $request->subcategory;
        $productList = ProductList::where('category', $category)->where('subcategory', $subcategory)->get();
        return response()->json($productList);
    }

    public function searchProduct(Request $request)
    {
        $search = $request->key;
        $productList = ProductList::where('title', 'like', '%' . $search . '%')
            ->orWhere('brand', 'like', '%' . $search . '%')
            ->get();
        return response()->json($productList);
    }


}
