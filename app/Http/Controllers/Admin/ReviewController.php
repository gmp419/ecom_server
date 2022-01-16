<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\ProductReview;

class ReviewController extends Controller
{
    //
    public function getReviews(Request $request)
    {
        $reviews = ProductReview::where('product_id', $request->id)
        ->orderBy('id', 'desc')
        ->limit(3)
        ->get();

        return response()->json($reviews);
    }
}
