<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Favourite;
use App\Models\ProductList;

class FavouriteController extends Controller
{
    //
    public function addToFavorite(Request $request){
        $product_code = $request->product_code;
        $email = $request->email;

        $product = ProductList::where('product_code', $product_code)->first();
        $product_name = $product->title;
        $product_image = $product->product_image;

        $favourite = Favourite::insert([
            'email' => $email,
            'product_code' => $product_code,
            'product_name' => $product_name,
            'image' => $product_image,
            'product_id' => $product->id,
        ]);

        if($favourite){
            return response()->json(['success' => true, 'message' => 'Product added to favorite list successfully.']);
        }else{
            return response()->json(['success' => false, 'message' => 'Something went wrong. Please try again.']);
        }
    }

    public function favoriteList(Request $request){
        $email = $request->email;

        $favourite = Favourite::where('email', $email)->get();

        if($favourite){
            return response()->json($favourite);
        }else{
            return response()->json(['message' => 'Something went wrong. Please try again.']);
        }
    }

    public function removeFavorite(Request $request){
        $product_code = $request->product_code;
        $email = $request->email;

        $favourite = Favourite::where('product_code', $product_code)->where('email', $email)->delete();

        if($favourite){
            return response()->json(['success' => true, 'message' => 'Product removed from favorite list successfully.']);
        }else{
            return response()->json(['success' => false, 'message' => 'Something went wrong. Please try again.']);
        }
    }
}
