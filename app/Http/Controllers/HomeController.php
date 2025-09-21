<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Sample featured listings data
        $featuredListings = [
            [
                'id' => 1,
                'title' => 'Modern Downtown Apartment',
                'description' => 'Beautiful 2-bedroom apartment in the heart of the city',
                'price' => 120,
                'image' => 'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?w=400',
                'location' => 'Downtown, New York',
                'rating' => 4.8,
                'creator' => 'John Smith'
            ],
            [
                'id' => 2,
                'title' => 'Cozy Mountain Cabin',
                'description' => 'Perfect getaway in the mountains with stunning views',
                'price' => 89,
                'image' => 'https://images.unsplash.com/photo-1449824913935-59a10b8d2000?w=400',
                'location' => 'Mountain View, Colorado',
                'rating' => 4.9,
                'creator' => 'Sarah Johnson'
            ],
            [
                'id' => 3,
                'title' => 'Beachfront Villa',
                'description' => 'Luxury villa with private beach access and ocean views',
                'price' => 250,
                'image' => 'https://images.unsplash.com/photo-1439066615861-d1af74d74000?w=400',
                'location' => 'Malibu, California',
                'rating' => 5.0,
                'creator' => 'Mike Davis'
            ]
        ];

        return view('welcome', compact('featuredListings'));
    }
}