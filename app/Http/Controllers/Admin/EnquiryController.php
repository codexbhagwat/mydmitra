<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactEnquiry;

class EnquiryController extends Controller
{
    public function index()
    {
        $enquiries = ContactEnquiry::latest()->paginate(15);
        return view('admin.enquiries.index', compact('enquiries'));
    }
}