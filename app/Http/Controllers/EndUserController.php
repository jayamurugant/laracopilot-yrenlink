<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EndUserController extends Controller
{
    private function checkAuth()
    {
        if (!session('user_logged_in') || session('user')['role'] !== 'EndUser') {
            return redirect()->route('login');
        }
        return null;
    }

    private function getListingsData()
    {
        return [
            [
                'id' => 1,
                'title' => 'Modern Downtown Apartment',
                'description' => 'Beautiful 2-bedroom apartment in the heart of the city with modern amenities, high-speed WiFi, and stunning city views.',
                'price' => 120,
                'image' => 'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?w=600',
                'location' => 'Downtown, New York',
                'rating' => 4.8,
                'creator_id' => 2,
                'creator' => 'John Smith',
                'amenities' => ['WiFi', 'Kitchen', 'Air Conditioning', 'Parking'],
                'available_dates' => ['2024-03-01', '2024-03-02', '2024-03-03', '2024-03-05', '2024-03-06'],
                'created_at' => '2024-02-01 14:30:00'
            ],
            [
                'id' => 2,
                'title' => 'Cozy Mountain Cabin',
                'description' => 'Perfect getaway in the mountains with stunning views, fireplace, and hiking trails nearby.',
                'price' => 89,
                'image' => 'https://images.unsplash.com/photo-1449824913935-59a10b8d2000?w=600',
                'location' => 'Mountain View, Colorado',
                'rating' => 4.9,
                'creator_id' => 4,
                'creator' => 'Mike Davis',
                'amenities' => ['Fireplace', 'Mountain View', 'Hiking', 'WiFi'],
                'available_dates' => ['2024-03-01', '2024-03-04', '2024-03-07', '2024-03-08', '2024-03-09'],
                'created_at' => '2024-02-10 16:45:00'
            ],
            [
                'id' => 3,
                'title' => 'Beachfront Villa',
                'description' => 'Luxury villa with private beach access and ocean views, perfect for a relaxing vacation.',
                'price' => 250,
                'image' => 'https://images.unsplash.com/photo-1439066615861-d1af74d74000?w=600',
                'location' => 'Malibu, California',
                'rating' => 5.0,
                'creator_id' => 2,
                'creator' => 'John Smith',
                'amenities' => ['Beach Access', 'Ocean View', 'Pool', 'WiFi', 'Kitchen'],
                'available_dates' => ['2024-03-02', '2024-03-03', '2024-03-06', '2024-03-10', '2024-03-11'],
                'created_at' => '2024-02-15 12:00:00'
            ]
        ];
    }

    private function getBookingsData()
    {
        $userId = session('user')['id'];
        return [
            [
                'id' => 1,
                'user_id' => $userId,
                'listing_id' => 1,
                'listing_title' => 'Modern Downtown Apartment',
                'check_in' => '2024-03-01',
                'check_out' => '2024-03-03',
                'total_amount' => 240,
                'status' => 'confirmed',
                'payment_status' => 'paid',
                'created_at' => '2024-02-20 10:30:00'
            ],
            [
                'id' => 2,
                'user_id' => $userId,
                'listing_id' => 2,
                'listing_title' => 'Cozy Mountain Cabin',
                'check_in' => '2024-03-05',
                'check_out' => '2024-03-07',
                'total_amount' => 178,
                'status' => 'pending',
                'payment_status' => 'pending',
                'created_at' => '2024-02-22 14:15:00'
            ]
        ];
    }

    public function dashboard()
    {
        $authCheck = $this->checkAuth();
        if ($authCheck) return $authCheck;

        $user = session('user');
        $recentBookings = array_slice($this->getBookingsData(), 0, 3);
        $recommendedListings = array_slice($this->getListingsData(), 0, 3);

        return view('enduser.dashboard', compact('user', 'recentBookings', 'recommendedListings'));
    }

    public function listings()
    {
        $authCheck = $this->checkAuth();
        if ($authCheck) return $authCheck;

        $listings = $this->getListingsData();
        return view('enduser.listings', compact('listings'));
    }

    public function viewListing($id)
    {
        $authCheck = $this->checkAuth();
        if ($authCheck) return $authCheck;

        $listings = $this->getListingsData();
        $listing = collect($listings)->firstWhere('id', (int)$id);

        if (!$listing) {
            return redirect()->route('enduser.listings')->with('error', 'Listing not found');
        }

        return view('enduser.listing-detail', compact('listing'));
    }

    public function bookings()
    {
        $authCheck = $this->checkAuth();
        if ($authCheck) return $authCheck;

        $bookings = $this->getBookingsData();
        return view('enduser.bookings', compact('bookings'));
    }
}