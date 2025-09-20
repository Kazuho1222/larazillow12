<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class RealtorListingController extends Controller
{
    public function index()
    {
        return Inertia::render(
            'Realtor/Index',
            ['listings' => Auth::user()->listings]
        );
    }
}
