@extends('layouts.app')

@section('title', $listing['title'] . ' - BookingPlatform')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50 py-8">
    <div class="max-w-7xl mx-auto px-4">
        <!-- Back Button -->
        <div class="mb-6">
            <a href="{{ route('enduser.listings') }}" class="inline-flex items-center text-slate-600 hover:text-blue-600 transition-colors duration-300">
                <i class="fas fa-arrow-left mr-2"></i>
                Back to Listings
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Image Gallery -->
                <div class="bg-white/80 backdrop-blur-md rounded-3xl shadow-xl overflow-hidden border border-white/50">
                    <div class="relative">
                        <img src="{{ $listing['image'] }}" alt="{{ $listing['title'] }}" class="w-full h-96 object-cover">
                        <div class="absolute top-4 left-4">
                            <div class="bg-white/90 backdrop-blur-sm rounded-lg px-3 py-1 flex items-center space-x-1">
                                <i class="fas fa-star text-yellow-500"></i>
                                <span class="font-semibold text-slate-800">{{ $listing['rating'] }}</span>
                            </div>
                        </div>
                        <button class="absolute top-4 right-4 w-12 h-12 bg-white/90 backdrop-blur-sm hover:bg-red-100 text-slate-600 hover:text-red-600 rounded-full transition-all duration-300 flex items-center justify-center">
                            <i class="fas fa-heart"></i>
                        </button>
                    </div>
                </div>

                <!-- Listing Details -->
                <div class="bg-white/80 backdrop-blur-md rounded-3xl shadow-xl p-8 border border-white/50">
                    <div class="flex items-start justify-between mb-6">
                        <div>
                            <h1 class="text-4xl font-bold text-slate-800 mb-2">{{ $listing['title'] }}</h1>
                            <div class="flex items-center space-x-4 text-slate-600">
                                <div class="flex items-center space-x-1">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span>{{ $listing['location'] }}</span>
                                </div>
                                <div class="flex items-center space-x-1">
                                    <i class="fas fa-user"></i>
                                    <span>Hosted by {{ $listing['creator'] }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="text-4xl font-bold text-slate-800">${{ $listing['price'] }}</div>
                            <div class="text-slate-500">per night</div>
                        </div>
                    </div>

                    <div class="border-t border-slate-200 pt-6">
                        <h2 class="text-2xl font-bold text-slate-800 mb-4">About this place</h2>
                        <p class="text-slate-600 leading-relaxed mb-6">
                            {{ $listing['description'] }}
                        </p>

                        <!-- Amenities -->
                        <h3 class="text-xl font-bold text-slate-800 mb-4">Amenities</h3>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                            @foreach($listing['amenities'] as $amenity)
                            <div class="flex items-center space-x-3 p-3 bg-slate-50 rounded-xl">
                                <i class="fas fa-check text-green-500"></i>
                                <span class="text-slate-700">{{ $amenity }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Reviews Section -->
                <div class="bg-white/80 backdrop-blur-md rounded-3xl shadow-xl p-8 border border-white/50">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-2xl font-bold text-slate-800">Reviews</h2>
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-star text-yellow-500"></i>
                            <span class="font-bold text-slate-800">{{ $listing['rating'] }}</span>
                            <span class="text-slate-500">(24 reviews)</span>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <!-- Sample Reviews -->
                        <div class="border-b border-slate-200 pb-6">
                            <div class="flex items-start space-x-4">
                                <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                                    <span class="text-white font-bold">A</span>
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center justify-between mb-2">
                                        <h4 class="font-semibold text-slate-800">Alice Johnson</h4>
                                        <div class="flex items-center space-x-1">
                                            <div class="flex space-x-1">
                                                @for($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star text-yellow-500 text-sm"></i>
                                                @endfor
                                            </div>
                                        </div>
                                    </div>
                                    <p class="text-slate-600 leading-relaxed">Amazing place with stunning views! The host was incredibly helpful and the location was perfect for our city exploration. Highly recommend!</p>
                                    <p class="text-sm text-slate-500 mt-2">2 weeks ago</p>
                                </div>
                            </div>
                        </div>

                        <div class="border-b border-slate-200 pb-6">
                            <div class="flex items-start space-x-4">
                                <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-teal-600 rounded-full flex items-center justify-center">
                                    <span class="text-white font-bold">M</span>
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center justify-between mb-2">
                                        <h4 class="font-semibold text-slate-800">Mark Wilson</h4>
                                        <div class="flex items-center space-x-1">
                                            <div class="flex space-x-1">
                                                @for($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star text-yellow-500 text-sm"></i>
                                                @endfor
                                            </div>
                                        </div>
                                    </div>
                                    <p class="text-slate-600 leading-relaxed">Great experience overall. Clean, comfortable, and exactly as described. Would definitely stay here again!</p>
                                    <p class="text-sm text-slate-500 mt-2">1 month ago</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button class="text-blue-600 hover:text-blue-700 font-medium mt-4">
                        Show all reviews
                    </button>
                </div>
            </div>

            <!-- Booking Sidebar -->
            <div class="lg:col-span-1">
                <div class="sticky top-8">
                    <div class="bg-white/80 backdrop-blur-md rounded-3xl shadow-xl p-8 border border-white/50">
                        <div class="text-center mb-6">
                            <div class="text-3xl font-bold text-slate-800">${{ $listing['price'] }}</div>
                            <div class="text-slate-500">per night</div>
                        </div>

                        <!-- Booking Form -->
                        <form action="{{ route('booking.create') }}" method="POST" id="bookingForm">
                            @csrf
                            <input type="hidden" name="listing_id" value="{{ $listing['id'] }}">
                            
                            <div class="space-y-4 mb-6">
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700 mb-2">Check In</label>
                                        <input type="date" name="check_in" id="checkIn" required class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700 mb-2">Check Out</label>
                                        <input type="date" name="check_out" id="checkOut" required class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    </div>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-2">Guests</label>
                                    <select name="guests" class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        <option value="1">1 Guest</option>
                                        <option value="2">2 Guests</option>
                                        <option value="3">3 Guests</option>
                                        <option value="4">4+ Guests</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Pricing Breakdown -->
                            <div class="border-t border-slate-200 pt-6 mb-6">
                                <div class="space-y-3">
                                    <div class="flex justify-between">
                                        <span class="text-slate-600">${{ $listing['price'] }} × <span id="nightCount">0</span> nights</span>
                                        <span class="text-slate-800" id="subtotal">$0</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-slate-600">Service fee</span>
                                        <span class="text-slate-800" id="serviceFee">$0</span>
                                    </div>
                                    <div class="border-t border-slate-200 pt-3">
                                        <div class="flex justify-between font-bold text-lg">
                                            <span class="text-slate-800">Total</span>
                                            <span class="text-slate-800" id="totalAmount">$0</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" name="total_amount" id="totalAmountInput" value="0">
                            
                            <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white py-4 rounded-xl font-semibold transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                Reserve Now
                            </button>
                        </form>

                        <p class="text-center text-sm text-slate-500 mt-4">
                            You won't be charged yet
                        </p>

                        <!-- Available Dates -->
                        <div class="mt-8">
                            <h3 class="font-semibold text-slate-800 mb-4">Available Dates</h3>
                            <div class="grid grid-cols-7 gap-1 text-center text-sm">
                                <div class="font-medium text-slate-600 py-2">S</div>
                                <div class="font-medium text-slate-600 py-2">M</div>
                                <div class="font-medium text-slate-600 py-2">T</div>
                                <div class="font-medium text-slate-600 py-2">W</div>
                                <div class="font-medium text-slate-600 py-2">T</div>
                                <div class="font-medium text-slate-600 py-2">F</div>
                                <div class="font-medium text-slate-600 py-2">S</div>
                                
                                <!-- Calendar days would be generated here -->
                                @for($i = 1; $i <= 31; $i++)
                                <div class="py-2 hover:bg-blue-100 rounded cursor-pointer 
                                    {{ in_array('2024-03-' . sprintf('%02d', $i), $listing['available_dates']) ? 'text-slate-800 hover:bg-blue-100' : 'text-slate-400 cursor-not-allowed' }}">
                                    {{ $i }}
                                </div>
                                @endfor
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    const pricePerNight = {{ $listing['price'] }};
    
    function updatePricing() {
        const checkIn = $('#checkIn').val();
        const checkOut = $('#checkOut').val();
        
        if (checkIn && checkOut) {
            const startDate = new Date(checkIn);
            const endDate = new Date(checkOut);
            const timeDiff = endDate.getTime() - startDate.getTime();
            const dayDiff = Math.ceil(timeDiff / (1000 * 3600 * 24));
            
            if (dayDiff > 0) {
                const subtotal = pricePerNight * dayDiff;
                const serviceFee = Math.round(subtotal * 0.15);
                const total = subtotal + serviceFee;
                
                $('#nightCount').text(dayDiff);
                $('#subtotal').text('$' + subtotal);
                $('#serviceFee').text('$' + serviceFee);
                $('#totalAmount').text('$' + total);
                $('#totalAmountInput').val(total);
            }
        }
    }
    
    $('#checkIn, #checkOut').on('change', updatePricing);
    
    // Set minimum dates
    const today = new Date().toISOString().split('T')[0];
    $('#checkIn').attr('min', today);
    
    $('#checkIn').on('change', function() {
        const checkInDate = new Date($(this).val());
        checkInDate.setDate(checkInDate.getDate() + 1);
        const minCheckOut = checkInDate.toISOString().split('T')[0];
        $('#checkOut').attr('min', minCheckOut);
    });
});
</script>
@endsection