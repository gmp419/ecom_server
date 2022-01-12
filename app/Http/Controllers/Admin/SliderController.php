<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomeSlider;

class SliderController extends Controller
{
    //
    public function getSliderImages(){
        $images = HomeSlider::all();
        return response()->json($images);
    }
   
}
