<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ListingController extends Controller
{
    public function uploadImage(Request $request)
    {
        // Simulate image upload
        $imagePath = 'https://images.unsplash.com/photo-' . rand(1000000000000, 9999999999999) . '?w=600';
        
        return response()->json([
            'success' => true,
            'image_url' => $imagePath
        ]);
    }
}