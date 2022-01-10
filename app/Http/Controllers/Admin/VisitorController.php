<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Visitor;


class VisitorController extends Controller
{
    public function getVisitorDetails(){
        $ip_address = $_SERVER['REMOTE_ADDR'];
        date_default_timezone_set('Canada/Atlantic');
        $visit_time = date('h:i:s');
        $visit_date = date('Y-m-d');
        $browser = $_SERVER['HTTP_USER_AGENT'];


        $visitor = Visitor::insert([
            'ip_address' => $ip_address,
            'visit_date' => $visit_date,
            'visit_time' => $visit_time,
            'browser' => $browser
        ]);

        return response()->json(['success' => $visitor]);
    }
}
