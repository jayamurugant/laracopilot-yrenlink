@extends('layouts.app')

@section('title', 'My Dashboard - BookingPlatform')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50 py-8">
    <div class="max-w-7xl mx-auto px-4">
        <!-- Header -->
        <div class="mb-8">
            <div class="bg-white/80 backdrop-blur-md rounded-3xl shadow-xl p-8 border border-white/50">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-4xl font-bold text-slate-800">Welcome back, {{ $user['name'] }}!</h1>
                        <p class="text-slate-600 mt-2">Ready for your next adventure?</p>
                    </div>
                    <div class="hidden md:block">
                        <div class="w-20 h-20 bg-gradient-to-r from-blue-600 to-purple-600 rounded-2xl flex items-center justify-center">
                            <i class="fas fa-user text-white text-2xl"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <a href="{{ route('enduser.listings') }}" class="group bg-white/80 backdrop-blur-md rounded-3xl p-6 shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 border border-white/50">
                <div class="flex items-center space-x-4">
                    <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-purple-600 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-search text-white text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-slate-800">Browse Listings</h3>
                        <p class="text-slate-600">Find your perfect stay</p>
                    </div>
                </div>
            </a>

            <a href="{{ route('enduser.bookings') }}" class="group bg-white/80 backdrop-blur-md rounded-3xl p-6 shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 border border-white/50">
                <div class="flex items-center space-x-4">
                    <div class="w-16 h-16 bg-gradient-to-r from-green-500 to-teal-600 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-calendar-check text-white text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-slate-800">My Bookings</h3>
                        <p class="text-slate-600">View your reservations</p>
                    </div>
                </div>
            </a>

            <div class="group bg-white/80 backdrop-blur-md rounded-3xl p-6 shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 border border-white/50">
                <div class="flex items-center space-x-4">
                    <div class="w-16 h-16 bg-gradient-to-r from-orange-500 to-red-600 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-heart text-white text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-slate-800">Wishlist</h3>
                        <p class="text-slate-600">Saved favorites</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Recent Bookings -->
            <div class="bg-white/80 backdrop-blur-md rounded-3xl shadow-xl p-8 border border-white/50">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-slate-800">Recent Bookings</h2>
                    <a href="{{ route('enduser.bookings') }}" class="text-blue-600 hover:text-blue-700 font-medium">View All</a>
                </div>

                <div class="space-y-4">
                    @forelse($recentBookings as $booking)
                    <div class="flex items-center justify-between p-4 bg-gradient-to-r from-slate-50 to-blue-50 rounded-2xl border border-slate-200">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-600 rounded-xl flex items-center justify-center">
                                <i class="fas fa-home text-white"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-slate-800">{{ $booking['listing_title'] }}</h3>
                                <p class="text-sm text-slate-600">{{ $booking['check_in'] }} - {{ $booking['check_out'] }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="font-bold text-slate-800">${{ $booking['total_amount'] }}</div>
                            <div class="text-sm">
                                <span class="px-2 py-1 rounded-full text-xs font-medium
                                    {{ $booking['status'] === 'confirmed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ ucfirst($booking['status']) }}
                                </span>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-8">
                        <i class="fas fa-calendar text-slate-400 text-4xl mb-4"></i>
                        <p class="text-slate-600">No bookings yet</p>
                        <a href="{{ route('enduser.listings') }}" class="text-blue-600 hover:text-blue-700 font-medium">Browse listings to get started</a>
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- Recommended Listings -->
            <div class="bg-white/80 backdrop-blur-md rounded-3xl shadow-xl p-8 border border-white/50">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-slate-800">Recommended for You</h2>
                    <a href="{{ route('enduser.listings') }}" class="text-blue-600 hover:text-blue-700 font-medium">View All</a>
                </div>

                <div class="space-y-4">
                    @foreach($recommendedListings as $listing)
                    <div class="group cursor-pointer" onclick="window.location.href='{{ route('enduser.listing.view', $listing['id']) }}'">
                        <div class="flex items-center space-x-4 p-4 bg-gradient-to-r from-slate-50 to-purple-50 rounded-2xl border border-slate-200 hover:shadow-lg transition-all duration-300">
                            <img src="{{ $listing['image'] }}" alt="{{ $listing['title'] }}" class="w-16 h-16 object-cover rounded-xl">
                            <div class="flex-1">
                                <h3 class="font-semibold text-slate-800 group-hover:text-blue-600 transition-colors duration-300">{{ $listing['title'] }}</h3>
                                <p class="text-sm text-slate-600">{{ $listing['location'] }}</p>
                                <div class="flex items-center space-x-2 mt-1">
                                    <div class="flex items-center space-x-1">
                                        <i class="fas fa-star text-yellow-500 text-xs"></i>
                                        <span class="text-sm font-medium text-slate-700">{{ $listing['rating'] }}</span>
                                    </div>
                                    <span class="text-sm text-slate-500">•</span>
                                    <span class="text-sm font-bold text-slate-800">${{ $listing['price'] }}/night</span>
                                </div>
                            </div>
                            <i class="fas fa-chevron-right text-slate-400 group-hover:text-blue-600 transition-colors duration-300"></i>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mt-8">
            <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-3xl p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-blue-100 text-sm">Total Bookings</p>
                        <p class="text-3xl font-bold">{{ count($recentBookings) }}</p>
                    </div>
                    <i class="fas fa-calendar-check text-4xl text-blue-200"></i>
                </div>
            </div>

            <div class="bg-gradient-to-r from-green-600 to-teal-600 rounded-3xl p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-green-100 text-sm">Countries Visited</p>
                        <p class="text-3xl font-bold">3</p>
                    </div>
                    <i class="fas fa-globe text-4xl text-green-200"></i>
                </div>
            </div>

            <div class="bg-gradient-to-r from-orange-600 to-red-600 rounded-3xl p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-orange-100 text-sm">Wishlist Items</p>
                        <p class="text-3xl font-bold">12</p>
                    </div>
                    <i class="fas fa-heart text-4xl text-orange-200"></i>
                </div>
            </div>

            <div class="bg-gradient-to-r from-purple-600 to-pink-600 rounded-3xl p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-purple-100 text-sm">Loyalty Points</p>
                        <p class="text-3xl font-bold">1,247</p>
                    </div>
                    <i class="fas fa-star text-4xl text-purple-200"></i>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection