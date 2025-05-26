<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GeocodeController extends Controller
{
    // @desc    make request to mapbox
    // @route   GET /geocode

    public function geocode(Request $request): array
    {
        $address = $request->input('address');
        $accessTonken = env('MAPBOX_API_KEY');

        $response = Http::get("https://api.mapbox.com/geocoding/v5/mapbox.places/{$address}.json", ['access_token' => $accessTonken]);

        return $response->json();
    }
}
