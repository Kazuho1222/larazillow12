<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Inertia\Inertia;

class IndexController extends Controller
{
    public function index()
    {
        // dd(FacadesAuth::user());
        return Inertia::render(
            'Index/Index',
            [
                'message' => 'Hello from Laravel!'
            ]
        );
    }

    public function show()
    {
        return Inertia::render('Index/Show');
    }
}
