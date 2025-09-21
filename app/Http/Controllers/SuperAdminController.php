<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SuperAdminController extends Controller
{
    private function checkAuth()
    {
        if (!session('user_logged_in') || session('user')['role'] !== 'SuperAdmin') {
            return redirect()->route('login');
        }
        return null;
    }

    private function getAllUsers()
    {
        return [
            [
                'id' => 1,
                'name' => 'Super Admin',
                'email' => 'admin@booking.com',
                'role' => 'SuperAdmin',
                'status' => 'active',
                'listings_count' => 0,
                'bookings_count' => 0,
                'created_at' => '2024-01-15 10:00:00'
            ],
            [
                'id' => 2,
                'name' => 'John Smith',
                'email' => 'john@example.com',
                'role' => 'Creator',
                'status' => 'active',
                'listings_count' => 2,
                'bookings_count' => 23,
                'created_at' => '2024-02-01 14:30:00'
            ],
            [
                'id' => 3,
                'name' => 'Sarah Johnson',
                'email' => 'sarah@example.com',
                'role' => 'EndUser',
                'status' => 'active',
                'listings_count' => 0,
                'bookings_count' => 5,
                'created_at' => '2024-02-05 09:15:00'
            ],
            [
                'id' => 4,
                'name' => 'Mike Davis',
                'email' => 'mike@example.com',
                'role' => 'Creator',
                'status' => 'active',
                'listings_count' => 1,
                'bookings_count' => 12,
                'created_at' => '2024-02-10 16:45:00'
            ],
            [
                'id' => 5,
                'name' => 'Emma Wilson',
                'email' => 'emma@example.com',
                'role' => 'EndUser',
                'status' => 'active',
                'listings_count' => 0,
                'bookings_count' => 3,
                'created_at' => '2024-02-12 11:20:00'
            ]
        ];
    }

    private function getAllListings()
    {
        return [
            [
                'id' => 1,
                'title' => 'Modern Downtown Apartment',
                'creator_name' => 'John Smith',
                'location' => 'Downtown, New York',
                'price' => 120,
                'status' => 'active',
                'bookings_count' => 15,
                'total_earnings' => 1800,
                'created_at' => '2024-02-01 14:30:00'
            ],
            [
                'id' => 2,
                'title' => 'Cozy Mountain Cabin',
                'creator_name' => 'Mike Davis',
                'location' => 'Mountain View, Colorado',
                'price' => 89,
                'status' => 'active',
                'bookings_count' => 12,
                'total_earnings' => 1068,
                'created_at' => '2024-02-10 16:45:00'
            ],
            [
                'id' => 3,
                'title' => 'Beachfront Villa',
                'creator_name' => 'John Smith',
                'location' => 'Malibu, California',
                'price' => 250,
                'status' => 'active',
                'bookings_count' => 8,
                'total_earnings' => 2000,
                'created_at' => '2024-02-15 12:00:00'
            ]
        ];
    }

    private function getAllBookings()
    {
        return [
            [
                'id' => 1,
                'user_name' => 'Sarah Johnson',
                'listing_title' => 'Modern Downtown Apartment',
                'creator_name' => 'John Smith',
                'check_in' => '2024-03-01',
                'check_out' => '2024-03-03',
                'total_amount' => 240,
                'status' => 'confirmed',
                'payment_status' => 'paid',
                'created_at' => '2024-02-20 10:30:00'
            ],
            [
                'id' => 2,
                'user_name' => 'Emma Wilson',
                'listing_title' => 'Cozy Mountain Cabin',
                'creator_name' => 'Mike Davis',
                'check_in' => '2024-03-05',
                'check_out' => '2024-03-07',
                'total_amount' => 178,
                'status' => 'pending',
                'payment_status' => 'pending',
                'created_at' => '2024-02-22 14:15:00'
            ],
            [
                'id' => 3,
                'user_name' => 'Sarah Johnson',
                'listing_title' => 'Beachfront Villa',
                'creator_name' => 'John Smith',
                'check_in' => '2024-03-10',
                'check_out' => '2024-03-12',
                'total_amount' => 500,
                'status' => 'confirmed',
                'payment_status' => 'paid',
                'created_at' => '2024-02-23 09:45:00'
            ]
        ];
    }

    private function getPaymentsData()
    {
        return [
            [
                'id' => 1,
                'booking_id' => 1,
                'user_name' => 'Sarah Johnson',
                'amount' => 240,
                'payment_method' => 'Razorpay',
                'transaction_id' => 'pay_razorpay_12345',
                'status' => 'completed',
                'created_at' => '2024-02-20 10:35:00'
            ],
            [
                'id' => 2,
                'booking_id' => 3,
                'user_name' => 'Sarah Johnson',
                'amount' => 500,
                'payment_method' => 'Stripe',
                'transaction_id' => 'pi_stripe_67890',
                'status' => 'completed',
                'created_at' => '2024-02-23 09:50:00'
            ],
            [
                'id' => 3,
                'booking_id' => 2,
                'user_name' => 'Emma Wilson',
                'amount' => 178,
                'payment_method' => 'Razorpay',
                'transaction_id' => 'pay_razorpay_54321',
                'status' => 'pending',
                'created_at' => '2024-02-22 14:20:00'
            ]
        ];
    }

    public function dashboard()
    {
        $authCheck = $this->checkAuth();
        if ($authCheck) return $authCheck;

        $users = $this->getAllUsers();
        $listings = $this->getAllListings();
        $bookings = $this->getAllBookings();
        $payments = $this->getPaymentsData();

        $stats = [
            'total_users' => count($users),
            'total_creators' => count(array_filter($users, fn($u) => $u['role'] === 'Creator')),
            'total_endusers' => count(array_filter($users, fn($u) => $u['role'] === 'EndUser')),
            'total_listings' => count($listings),
            'total_bookings' => count($bookings),
            'total_revenue' => array_sum(array_column($payments, 'amount')),
            'pending_bookings' => count(array_filter($bookings, fn($b) => $b['status'] === 'pending')),
            'completed_payments' => count(array_filter($payments, fn($p) => $p['status'] === 'completed'))
        ];

        return view('superadmin.dashboard', compact('stats', 'users', 'listings', 'bookings'));
    }

    public function users()
    {
        $authCheck = $this->checkAuth();
        if ($authCheck) return $authCheck;

        $users = $this->getAllUsers();
        return view('superadmin.users', compact('users'));
    }

    public function listings()
    {
        $authCheck = $this->checkAuth();
        if ($authCheck) return $authCheck;

        $listings = $this->getAllListings();
        return view('superadmin.listings', compact('listings'));
    }

    public function bookings()
    {
        $authCheck = $this->checkAuth();
        if ($authCheck) return $authCheck;

        $bookings = $this->getAllBookings();
        return view('superadmin.bookings', compact('bookings'));
    }

    public function payments()
    {
        $authCheck = $this->checkAuth();
        if ($authCheck) return $authCheck;

        $payments = $this->getPaymentsData();
        return view('superadmin.payments', compact('payments'));
    }

    public function deleteUser($id)
    {
        $authCheck = $this->checkAuth();
        if ($authCheck) return $authCheck;

        // In real application, this would delete from database
        session()->flash('success', 'User deleted successfully!');
        return redirect()->route('superadmin.users');
    }

    public function deleteListing($id)
    {
        $authCheck = $this->checkAuth();
        if ($authCheck) return $authCheck;

        // In real application, this would delete from database
        session()->flash('success', 'Listing deleted successfully!');
        return redirect()->route('superadmin.listings');
    }
}