<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class RealtorListingController extends Controller
{
    use AuthorizesRequests;
    // public function __construct()
    // {
    //     $this->authorizeResource(Listing::class, 'listing');
    // }

    public function index()
    {
        return Inertia::render(
            'Realtor/Index',
            ['listings' => Auth::user()->listings]
        );
    }

    public function destroy(Listing $listing)
    {
        $listing->deleteOrFail();

        return redirect()->back()
            ->with('success', 'Listing was deleted!');
    }
}
