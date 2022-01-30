<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomeSlider;
use Image;

class SliderController extends Controller
{
    //api method for react
    public function getSliderImages()
    {
        $images = HomeSlider::all();
        return response()->json($images);
    }

    //admin laravel methods
    public function index()
    {
        $images = HomeSlider::paginate(10);
        return view('backend.slider.index', compact('images'));
    }

    public function create()
    {
        return view('backend.slider.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'slider_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $image = $request->file('slider_image');
        $imageName = time().'.'.$image->getClientOriginalExtension();
        // Image::make($image)->resize(1024, 380)->save(public_path('upload/sliderImages/'.$imageName));
        $imageurl = env('BASE_URL') .'/upload/sliderImages/'.$imageName;

        HomeSlider::create([
            'slider_image' => $imageurl,
        ]);

        return redirect()->route('slider.all');
    }

    public function edit($id)
    {
        $image = HomeSlider::find($id);
        return view('backend.slider.edit', compact('image'));
    }

    public function update(Request $request){
        $validated = $request->validate([
            'slider_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $slider = HomeSlider::find($request->id);

        $image = $request->file('slider_image');
        $imageName = time().'.'.$image->getClientOriginalExtension();
        // Image::make($image)->resize(1024, 380)->save(public_path('upload/sliderImages/'.$imageName));
        $imageurl = env('BASE_URL') .'/upload/sliderImages/'.$imageName;

        $slider->update([
            'slider_image' => $imageurl,
        ]);

        return redirect()->route('slider.all');
    }

    public function destroy($id){
        HomeSlider::find($id)->delete();
        return redirect()->route('slider.all')->with('success', 'Slider image deleted successfully');
    }
}
