<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Service;

class FrontendController extends Controller
{
    public function home()
    {
        $services = Service::where('is_active', true)->take(6)->get();
        return view('frontend.home', compact('services'));
    }

    public function services()
    {
        $services = Service::where('is_active', true)->paginate(9);
        return view('frontend.services', compact('services'));
    }
}


