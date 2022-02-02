<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\ProductDetails;
use App\Models\Subcategory;
use App\Models\ProductList;
use Image;

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

    public function getProductListBySubategory(Request $request)
    {
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

    public function getSuggestedProduct(Request $request)
    {
        $subcategory = $request->key;
        $productList = ProductList::where('subcategory', $subcategory)
            ->orderBy('id', 'desc')
            ->limit(6)
            ->get();
        return response()->json($productList);
    }


    //method for admin laravel part

    public function index()
    {
        $productLists = ProductList::latest()->paginate(10);
        return view('backend.product.index', compact('productLists'));
    }

    public function add()
    {
        $categories = Category::orderBy('category_name', 'asc')->get();
        $subcategories = Subcategory::orderBy('subcategory_name', 'asc')->get();
        return view('backend.product.add', compact('categories', 'subcategories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image1' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image2' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image3' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image4' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'required',
            'short_description' => 'required',
            'long_description' => 'required',
            'product_code' => 'required|unique:product_lists',
            'price' => 'required',
            'offer_price' => 'required',
            'category' => 'required',
            'subcategory' => 'required',
            'brand' => 'required',
            'remark' => 'required',
            'star_rating' => 'required',
            'size' => 'required',
            'color' => 'required',
        ]);

        $image = $request->file('product_image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        //Image::make($image)->resize(700, 950)->save(public_path('upload/products/' . $imageName));
        $product_image = env('BASE_URL') . '/upload/products/' . $imageName;

        $product_id = ProductList::insertGetId([
            'title' => $request->title,
            'price' => $request->price,
            'offer_price' => $request->offer_price,
            'product_image' => $product_image,
            'category' => $request->category,
            'subcategory' => $request->subcategory,
            'remark' => $request->remark,
            'brand' => $request->brand,
            'star_rating' => $request->star_rating,
            'product_code' => $request->product_code,
            'created_at' => now(),
            'updated_at' => now(),

            // 'short_description' => $request->short_description,
            // 'long_description' => $request->long_description,
            // 'size' => $request->size,
            // 'color' => $request->color,
        ]);

        //insert into productdetails table
        $image1 = $request->file('image1');
        $imageName1 = hexdec(uniqid()) . '.' . $image1->getClientOriginalExtension();
        //Image::make($image1)->resize(700, 950)->save(public_path('upload/products/' . $imageName1));
        $image_url1 = env('BASE_URL') . '/upload/products/' . $imageName1;

        $image2 = $request->file('image2');
        $imageName2 = hexdec(uniqid()) . '.' . $image2->getClientOriginalExtension();
        //Image::make($image2)->resize(700, 950)->save(public_path('upload/products/' . $imageName2));
        $image_url2 = env('BASE_URL') . '/upload/products/' . $imageName2;

        $image3 = $request->file('image3');
        $imageName3 = hexdec(uniqid()) . '.' . $image3->getClientOriginalExtension();
        //Image::make($image3)->resize(700, 950)->save(public_path('upload/products/' . $imageName3));
        $image_url3 = env('BASE_URL') . '/upload/products/' . $imageName3;

        $image4 = $request->file('image4');
        $imageName4 = hexdec(uniqid()) . '.' . $image4->getClientOriginalExtension();
        //Image::make($image4)->resize(700, 950)->save(public_path('upload/products/' . $imageName4));
        $image_url4 = env('BASE_URL') . '/upload/products/' . $imageName4;

        ProductDetails::insert([
            'product_id' => $product_id,
            'image1' => $image_url1,
            'image2' => $image_url2,
            'image3' => $image_url3,
            'image4' => $image_url4,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,
            'size' => $request->size,
            'color' => $request->color,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Product Added Successfully');
    }

    public function edit(Request $request)
    {
        $product = ProductList::find($request->id);
        $productDetail = ProductDetails::where('product_id', $request->id)->first();
        $categories = Category::orderBy('category_name', 'asc')->get();
        $subcategories = Subcategory::orderBy('subcategory_name', 'asc')->get();
        return view('backend.product.edit', compact('product', 'productDetail', 'categories', 'subcategories'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'product_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image1' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image2' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image3' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image4' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'required',
            'short_description' => 'required',
            'long_description' => 'required',
            'product_code' => 'required',
            'price' => 'required',
            'offer_price' => 'required',
            'category' => 'required',
            'subcategory' => 'required',
            'brand' => 'required',
            'remark' => 'required',
            'star_rating' => 'required',
            'size' => 'required',
            'color' => 'required',
        ]);

        $product = ProductList::find($request->id);

        if ($request->product_image != null) {
            $image = $request->file('product_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            //Image::make($image)->resize(700, 950)->save(public_path('upload/products/' . $imageName));
            $product_image = env('BASE_URL') . '/upload/products/' . $imageName;
        } else {
            $product_image = $product->product_image;
        }

        $product_id = $product->update([
            'title' => $request->title,
            'price' => $request->price,
            'offer_price' => $request->offer_price,
            'product_image' => $product_image,
            'category' => $request->category,
            'subcategory' => $request->subcategory,
            'remark' => $request->remark,
            'brand' => $request->brand,
            'star_rating' => $request->star_rating,
            'product_code' => $request->product_code,
            'created_at' => now(),
            'updated_at' => now(),
        ]);


        //insert into productdetails  table
        if ($request->image1 != null || $request->image2 != null || $request->image3 != null || $request->image4 != null) {
            $image1 = $request->file('image1');
            $imageName1 = hexdec(uniqid()) . '.' . $image1->getClientOriginalExtension();
            //Image::make($image1)->resize(700, 950)->save(public_path('upload/products/' . $imageName1));
            $image_url1 = env('BASE_URL') . '/upload/products/' . $imageName1;


            $image2 = $request->file('image2');
            $imageName2 = hexdec(uniqid()) . '.' . $image2->getClientOriginalExtension();
            //Image::make($image2)->resize(700, 950)->save(public_path('upload/products/' . $imageName2));
            $image_url2 = env('BASE_URL') . '/upload/products/' . $imageName2;

            $image3 = $request->file('image3');
            $imageName3 = hexdec(uniqid()) . '.' . $image3->getClientOriginalExtension();
            //Image::make($image3)->resize(700, 950)->save(public_path('upload/products/' . $imageName3));
            $image_url3 = env('BASE_URL') . '/upload/products/' . $imageName3;

            $image4 = $request->file('image4');
            $imageName4 = hexdec(uniqid()) . '.' . $image4->getClientOriginalExtension();
            //Image::make($image4)->resize(700, 950)->save(public_path('upload/products/' . $imageName4));
            $image_url4 = env('BASE_URL') . '/upload/products/' . $imageName4;
        } else {
            $image_url1 = ProductDetails::where('product_id', $request->id)->value('image1');
            $image_url2 = ProductDetails::where('product_id', $request->id)->value('image2');
            $image_url3 = ProductDetails::where('product_id', $request->id)->value('image3');
            $image_url4 = ProductDetails::where('product_id', $request->id)->value('image4');
           
        }

        ProductDetails::insert([
            'product_id' => $product->id,
            'image1' => $image_url1,
            'image2' => $image_url2,
            'image3' => $image_url3,
            'image4' => $image_url4,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,
            'size' => $request->size,
            'color' => $request->color,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('product.all')->with('success', 'Product Added Successfully');
    }

    public function delete(Request $request)
    {
        ProductDetails::where('product_id', $request->id)->delete();
        ProductList::find($request->id)->delete();
        return redirect()->back()->with('success', 'Product Deleted Successfully');
    }
}
