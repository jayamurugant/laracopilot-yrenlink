@extends('layouts.app')

@section('title', 'Browse Listings - BookingPlatform')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50 py-8">
    <div class="max-w-7xl mx-auto px-4">
        <!-- Header -->
        <div class="mb-8">
            <div class="bg-white/80 backdrop-blur-md rounded-3xl shadow-xl p-8 border border-white/50">
                <h1 class="text-4xl font-bold text-slate-800 mb-4">Discover Amazing Places</h1>
                <p class="text-slate-600">Find your perfect accommodation from our curated collection</p>
            </div>
        </div>

        <!-- Filters -->
        <div class="mb-8">
            <div class="bg-white/80 backdrop-blur-md rounded-3xl shadow-lg p-6 border border-white/50">
                <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Location</label>
                        <input type="text" placeholder="Where to?" class="w-full px-4 py-2 border border-slate-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Check In</label>
                        <input type="date" class="w-full px-4 py-2 border border-slate-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Check Out</label>
                        <input type="date" class="w-full px-4 py-2 border border-slate-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Guests</label>
                        <select class="w-full px-4 py-2 border border-slate-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option>1 Guest</option>
                            <option>2 Guests</option>
                            <option>3+ Guests</option>
                        </select>
                    </div>
                    <div class="flex items-end">
                        <button class="w-full bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white py-2 rounded-xl font-semibold transition-all duration-300">
                            Search
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Listings Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($listings as $listing)
            <div class="group bg-white/80 backdrop-blur-md rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-3 overflow-hidden border border-white/50">
                <div class="relative overflow-hidden">
                    <img src="{{ $listing['image'] }}" alt="{{ $listing['title'] }}" class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute top-4 left-4">
                        <span class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-3 py-1 rounded-full text-sm font-semibold">
                            Available
                        </span>
                    </div>
                    <div class="absolute top-4 right-4">
                        <div class="bg-white/90 backdrop-blur-sm rounded-lg px-2 py-1 flex items-center space-x-1">
                            <i class="fas fa-star text-yellow-500 text-xs"></i>
                            <span class="text-sm font-semibold text-slate-800">{{ $listing['rating'] }}</span>
                        </div>
                    </div>
                    <button class="absolute bottom-4 right-4 w-10 h-10 bg-white/90 backdrop-blur-sm hover:bg-red-100 text-slate-600 hover:text-red-600 rounded-full transition-all duration-300 flex items-center justify-center">
                        <i class="fas fa-heart"></i>
                    </button>
                </div>
                
                <div class="p-6">
                    <div class="flex items-center justify-between mb-3">
                        <h3 class="text-xl font-bold text-slate-800 group-hover:text-blue-600 transition-colors duration-300">
                            {{ $listing['title'] }}
                        </h3>
                        <div class="text-right">
                            <div class="text-2xl font-bold text-slate-800">${{ $listing['price'] }}</div>
                            <div class="text-sm text-slate-500">per night</div>
                        </div>
                    </div>
                    
                    <p class="text-slate-600 mb-4 leading-relaxed">
                        {{ $listing['description'] }}
                    </p>
                    
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center space-x-2 text-slate-500">
                            <i class="fas fa-map-marker-alt"></i>
                            <span class="text-sm">{{ $listing['location'] }}</span>
                        </div>
                        <div class="text-sm text-slate-500">
                            by {{ $listing['creator'] }}
                        </div>
                    </div>

                    <!-- Amenities -->
                    <div class="mb-4">
                        <div class="flex flex-wrap gap-2">
                            @foreach(array_slice($listing['amenities'], 0, 3) as $amenity)
                            <span class="px-2 py-1 bg-slate-100 text-slate-600 text-xs rounded-lg">{{ $amenity }}</span>
                            @endforeach
                            @if(count($listing['amenities']) > 3)
                            <span class="px-2 py-1 bg-blue-100 text-blue-600 text-xs rounded-lg">+{{ count($listing['amenities']) - 3 }} more</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="flex space-x-3">
                        <a href="{{ route('enduser.listing.view', $listing['id']) }}" class="flex-1 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white py-3 rounded-xl font-semibold text-center transition-all duration-300 shadow-md hover:shadow-lg">
                            View Details
                        </a>
                        <button class="px-4 py-3 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-xl font-semibold transition-all duration-300">
                            <i class="fas fa-share-alt"></i>
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Load More -->
        <div class="text-center mt-12">
            <button class="bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white px-8 py-4 rounded-xl font-semibold transition-all duration-300 shadow-lg hover:shadow-xl">
                Load More Listings
            </button>
        </div>
    </div>
</div>
@endsection