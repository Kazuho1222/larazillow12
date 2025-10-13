<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class ListingController extends Controller
{

    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filters = $request->only([
            'priceForm',
            'priceTo',
            'beds',
            'baths',
            'areaForm',
            'areaTo'
        ]);
        return Inertia::render(
            'Listing/Index',
            [
                'filters' => $filters,
                'listings' => Listing::mostRecent()
                    ->filter($filters)
                    ->withoutSold()
                    ->paginate(10)
                    ->withQueryString()
            ]
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Listing $listing)
    {
        $listing->load(['images']);
        $offer = !Auth::user() ?
            null : $listing->offers()->byMe()->first();

        return Inertia::render(
            'Listing/Show',
            [
                'listing' => $listing,
                'offerMade' => $offer
            ]
        );
    }
}
