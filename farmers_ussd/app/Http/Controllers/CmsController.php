<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Enquiry;

class CmsController extends Controller
{
    // Function To Retrieve Enquiries
    public function getEnquiries(){
        $enquiries = Enquiry::orderBy('id','Desc')->get();
        $enquiries = json_encode($enquiries);
        return $enquiries;
    }

    //Function to see enquiries
    public function viewEnquiries(){
        return view('admin.enquiries.view_enquiries');
    }
}
