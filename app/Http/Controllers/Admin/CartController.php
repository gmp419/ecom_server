<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\ProductList;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $email = $request->input('user_email');
        $size = $request->input('product_size');
        $color = $request->input('color');
        $quantity = $request->input('quantity');
        $product_code = $request->input('product_code');

        $product = ProductList::where('product_code', $product_code)->first();
        $price = $product->price;
        $special_price = $product->offer_price;

        if($special_price == "na") {
            $total_price = $price * $quantity;
            $unit_price = $price;
        } else {
            $total_price = $special_price * $quantity;
            $unit_price = $special_price;
        }

        $result = Cart::insert([
            'user_email' => $email,
            'product_size' => $size,
            'color' => $color,
            'quantity' => $quantity,
            'product_code' => $product_code,
            'total_price' => $total_price,
            'unit_price' => $unit_price,
            'product_image' => $product->product_image,
            'product_name' => $product->title,
        ]);

        if($result) {
            return response()->json([
                'status' => 'success',
                'message' => 'Product added to cart successfully.',
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong.',
            ]);
        }

    }

    public function countCart(Request $request){
        $user_email = $request->user_email;
        $result = Cart::where('user_email', $user_email)->count();
        return response()->json([
            'status' => 'success',
            'message' => 'Cart count successfully.',
            'result' => $result,
        ]);

    }

    
}
