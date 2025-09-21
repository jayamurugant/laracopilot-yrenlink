<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CreatorController extends Controller
{
    private function checkAuth()
    {
        if (!session('user_logged_in') || session('user')['role'] !== 'Creator') {
            return redirect()->route('login');
        }
        return null;
    }

    private function getCreatorListings()
    {
        $creatorId = session('user')['id'];
        $allListings = [
            [
                'id' => 1,
                'title' => 'Modern Downtown Apartment',
                'description' => 'Beautiful 2-bedroom apartment in the heart of the city',
                'price' => 120,
                'image' => 'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?w=400',
                'location' => 'Downtown, New York',
                'creator_id' => 2,
                'status' => 'active',
                'bookings_count' => 15,
                'total_earnings' => 1800,
                'created_at' => '2024-02-01 14:30:00'
            ],
            [
                'id' => 3,
                'title' => 'Beachfront Villa',
                'description' => 'Luxury villa with private beach access',
                'price' => 250,
                'image' => 'https://images.unsplash.com/photo-1439066615861-d1af74d74000?w=400',
                'location' => 'Malibu, California',
                'creator_id' => 2,
                'status' => 'active',
                'bookings_count' => 8,
                'total_earnings' => 2000,
                'created_at' => '2024-02-15 12:00:00'
            ],
            [
                'id' => 2,
                'title' => 'Cozy Mountain Cabin',
                'description' => 'Perfect getaway in the mountains',
                'price' => 89,
                'image' => 'https://images.unsplash.com/photo-1449824913935-59a10b8d2000?w=400',
                'location' => 'Mountain View, Colorado',
                'creator_id' => 4,
                'status' => 'active',
                'bookings_count' => 12,
                'total_earnings' => 1068,
                'created_at' => '2024-02-10 16:45:00'
            ]
        ];

        return array_filter($allListings, function($listing) use ($creatorId) {
            return $listing['creator_id'] == $creatorId;
        });
    }

    private function getCreatorBookings()
    {
        return [
            [
                'id' => 1,
                'listing_title' => 'Modern Downtown Apartment',
                'guest_name' => 'Sarah Johnson',
                'check_in' => '2024-03-01',
                'check_out' => '2024-03-03',
                'total_amount' => 240,
                'status' => 'confirmed',
                'created_at' => '2024-02-20 10:30:00'
            ],
            [
                'id' => 3,
                'listing_title' => 'Beachfront Villa',
                'guest_name' => 'Emma Wilson',
                'check_in' => '2024-03-10',
                'check_out' => '2024-03-12',
                'total_amount' => 500,
                'status' => 'pending',
                'created_at' => '2024-02-22 16:20:00'
            ]
        ];
    }

    public function dashboard()
    {
        $authCheck = $this->checkAuth();
        if ($authCheck) return $authCheck;

        $user = session('user');
        $listings = $this->getCreatorListings();
        $recentBookings = array_slice($this->getCreatorBookings(), 0, 5);
        
        $totalListings = count($listings);
        $totalBookings = array_sum(array_column($listings, 'bookings_count'));
        $totalEarnings = array_sum(array_column($listings, 'total_earnings'));

        return view('creator.dashboard', compact('user', 'listings', 'recentBookings', 'totalListings', 'totalBookings', 'totalEarnings'));
    }

    public function listings()
    {
        $authCheck = $this->checkAuth();
        if ($authCheck) return $authCheck;

        $listings = $this->getCreatorListings();
        return view('creator.listings', compact('listings'));
    }

    public function createListing()
    {
        $authCheck = $this->checkAuth();
        if ($authCheck) return $authCheck;

        return view('creator.create-listing');
    }

    public function storeListing(Request $request)
    {
        $authCheck = $this->checkAuth();
        if ($authCheck) return $authCheck;

        // In real application, this would save to database
        session()->flash('success', 'Listing created successfully!');
        return redirect()->route('creator.listings');
    }

    public function editListing($id)
    {
        $authCheck = $this->checkAuth();
        if ($authCheck) return $authCheck;

        $listings = $this->getCreatorListings();
        $listing = collect($listings)->firstWhere('id', (int)$id);

        if (!$listing) {
            return redirect()->route('creator.listings')->with('error', 'Listing not found');
        }

        return view('creator.edit-listing', compact('listing'));
    }

    public function updateListing(Request $request, $id)
    {
        $authCheck = $this->checkAuth();
        if ($authCheck) return $authCheck;

        // In real application, this would update in database
        session()->flash('success', 'Listing updated successfully!');
        return redirect()->route('creator.listings');
    }

    public function deleteListing($id)
    {
        $authCheck = $this->checkAuth();
        if ($authCheck) return $authCheck;

        // In real application, this would delete from database
        session()->flash('success', 'Listing deleted successfully!');
        return redirect()->route('creator.listings');
    }

    public function bookings()
    {
        $authCheck = $this->checkAuth();
        if ($authCheck) return $authCheck;

        $bookings = $this->getCreatorBookings();
        return view('creator.bookings', compact('bookings'));
    }
}