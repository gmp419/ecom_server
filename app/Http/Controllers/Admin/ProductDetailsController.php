<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductDetails;
use App\Models\ProductList;

class ProductDetailsController extends Controller
{
    //
    public function getProductDetails(Request $request)
    {
        $productDetails = ProductDetails::where('product_id', $request->id)->get();
        $productList = ProductList::where('id', $request->id)->get();

        // return response()->json([
        //     'productDetails' => $productDetails,
        //     'productList' => $productList
        // ]);

        $item = [
            'productDetails' => $productDetails,
            'productList' => $productList
        ];
        
        return $item;
    }
}
