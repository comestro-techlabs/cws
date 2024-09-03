<?php

namespace App\Http\Controllers;

use App\Models\Enquiry;
use Illuminate\Http\Request;

class EnquiryController extends Controller
{
    public function storeEnquiry(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'mobile' => 'required|digits:10|regex:/^[0-9]{10}$/',
        ]);

        $data = new Enquiry();
        $data->name = $request->name;
        $data->mobile = $request->mobile;
        $data->message = $request->message;
        $data->email = $request->email;
        $data->save();

        return redirect('/')->with('success', 'Request added successfully.');
    }

}
