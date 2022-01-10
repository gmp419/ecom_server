<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    //
    public function contactUs(Request $request){

        date_default_timezone_set('Canada/Atlantic');

        $contact = Contact::insert([
            'name'=> $request->name,
            'contact_number'=> $request->contact_number,
            'email'=> $request->email,
            'message'=> $request->message,
            'date_submitted'=> date('Y-m-d H:i:s')
        ]);

        return response()->json(['Successfully send a message' => $contact]);
    }
}
