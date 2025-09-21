@extends('layouts.app')

@section('title', 'BookingPlatform - Discover Amazing Places')

@section('content')
<!-- Hero Section -->
<section class="relative min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-900 via-purple-900 to-indigo-900">
    <div class="absolute inset-0 bg-black/40"></div>
    <div class="absolute inset-0 bg-gradient-to-r from-blue-600/20 to-purple-600/20"></div>
    
    <div class="relative z-10 text-center text-white max-w-6xl mx-auto px-4">
        <h1 class="text-5xl md:text-7xl font-bold mb-6 bg-clip-text text-transparent bg-gradient-to-r from-white via-blue-100 to-purple-200">
            Discover Your Perfect Stay
        </h1>
        <p class="text-xl md:text-2xl mb-8 text-blue-100 max-w-3xl mx-auto">
            Book unique accommodations and experiences from local hosts around the world
        </p>
        
        <!-- Search Bar -->
        <div class="bg-white/10 backdrop-blur-md rounded-2xl p-6 mb-8 max-w-4xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="relative">
                    <input type="text" placeholder="Where are you going?" class="w-full px-4 py-3 rounded-xl bg-white/20 border border-white/30 text-white placeholder-white/70 focus:outline-none focus:ring-2 focus:ring-white/50">
                    <i class="fas fa-map-marker-alt absolute right-3 top-1/2 transform -translate-y-1/2 text-white/70"></i>
                </div>
                <div class="relative">
                    <input type="date" class="w-full px-4 py-3 rounded-xl bg-white/20 border border-white/30 text-white focus:outline-none focus:ring-2 focus:ring-white/50">
                </div>
                <div class="relative">
                    <input type="date" class="w-full px-4 py-3 rounded-xl bg-white/20 border border-white/30 text-white focus:outline-none focus:ring-2 focus:ring-white/50">
                </div>
                <button class="bg-gradient-to-r from-orange-500 to-red-600 hover:from-orange-600 hover:to-red-700 text-white px-6 py-3 rounded-xl font-semibold transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                    <i class="fas fa-search mr-2"></i>Search
                </button>
            </div>
        </div>

        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            @if(!session('user_logged_in'))
                <a href="{{ route('register') }}" class="bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white px-8 py-4 rounded-xl font-semibold transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                    Start Your Journey
                </a>
                <a href="{{ route('register') }}" class="bg-white/20 backdrop-blur-md border border-white/30 text-white px-8 py-4 rounded-xl font-semibold hover:bg-white/30 transition-all duration-300">
                    Become a Host
                </a>
            @else
                @if(session('user')['role'] === 'EndUser')
                    <a href="{{ route('enduser.listings') }}" class="bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white px-8 py-4 rounded-xl font-semibold transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                        Browse Listings
                    </a>
                @elseif(session('user')['role'] === 'Creator')
                    <a href="{{ route('creator.listings.create') }}" class="bg-gradient-to-r from-green-600 to-teal-600 hover:from-green-700 hover:to-teal-700 text-white px-8 py-4 rounded-xl font-semibold transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                        Create New Listing
                    </a>
                @endif
            @endif
        </div>
    </div>
</section>

<!-- Featured Listings Section -->
<section id="listings" class="py-20 bg-gradient-to-br from-slate-50 to-white">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-bold text-slate-800 mb-6">
                Featured Destinations
            </h2>
            <p class="text-xl text-slate-600 max-w-3xl mx-auto">
                Discover handpicked accommodations that offer unique experiences and exceptional hospitality
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($featuredListings as $listing)
            <div class="group bg-white rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-3 overflow-hidden border border-slate-100">
                <div class="relative overflow-hidden">
                    <img src="{{ $listing['image'] }}" alt="{{ $listing['title'] }}" class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute top-4 left-4">
                        <span class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-3 py-1 rounded-full text-sm font-semibold">
                            Featured
                        </span>
                    </div>
                    <div class="absolute top-4 right-4">
                        <div class="bg-white/90 backdrop-blur-sm rounded-lg px-2 py-1 flex items-center space-x-1">
                            <i class="fas fa-star text-yellow-500 text-xs"></i>
                            <span class="text-sm font-semibold text-slate-800">{{ $listing['rating'] }}</span>
                        </div>
                    </div>
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
                    
                    <div class="flex space-x-3">
                        @if(session('user_logged_in') && session('user')['role'] === 'EndUser')
                            <a href="{{ route('enduser.listing.view', $listing['id']) }}" class="flex-1 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white py-3 rounded-xl font-semibold text-center transition-all duration-300 shadow-md hover:shadow-lg">
                                Book Now
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="flex-1 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white py-3 rounded-xl font-semibold text-center transition-all duration-300 shadow-md hover:shadow-lg">
                                Login to Book
                            </a>
                        @endif
                        <button class="w-12 h-12 bg-slate-100 hover:bg-red-100 text-slate-600 hover:text-red-600 rounded-xl transition-all duration-300 flex items-center justify-center">
                            <i class="fas fa-heart"></i>
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-20 bg-gradient-to-br from-blue-50 via-purple-50 to-pink-50">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-bold text-slate-800 mb-6">
                Why Choose BookingPlatform?
            </h2>
            <p class="text-xl text-slate-600 max-w-3xl mx-auto">
                Experience the difference with our premium booking platform designed for modern travelers
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div class="bg-white/80 backdrop-blur-md rounded-3xl p-8 shadow-xl hover:shadow-2xl transition-all duration-500 hover:-translate-y-3 border border-white/50">
                <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-purple-600 rounded-2xl flex items-center justify-center mb-6">
                    <i class="fas fa-shield-alt text-white text-2xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-slate-800 mb-4">Secure Payments</h3>
                <p class="text-slate-600 mb-6 leading-relaxed">
                    Multiple payment options including Razorpay and Stripe with bank-level security and fraud protection.
                </p>
                <ul class="text-sm text-slate-500 space-y-2">
                    <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i>256-bit SSL encryption</li>
                    <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i>PCI DSS compliant</li>
                </ul>
            </div>

            <div class="bg-white/80 backdrop-blur-md rounded-3xl p-8 shadow-xl hover:shadow-2xl transition-all duration-500 hover:-translate-y-3 border border-white/50">
                <div class="w-16 h-16 bg-gradient-to-r from-green-500 to-teal-600 rounded-2xl flex items-center justify-center mb-6">
                    <i class="fas fa-calendar-check text-white text-2xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-slate-800 mb-4">Easy Booking</h3>
                <p class="text-slate-600 mb-6 leading-relaxed">
                    Intuitive calendar system for seamless booking experience with instant confirmation and flexible dates.
                </p>
                <ul class="text-sm text-slate-500 space-y-2">
                    <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i>Instant booking confirmation</li>
                    <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i>Flexible cancellation</li>
                </ul>
            </div>

            <div class="bg-white/80 backdrop-blur-md rounded-3xl p-8 shadow-xl hover:shadow-2xl transition-all duration-500 hover:-translate-y-3 border border-white/50">
                <div class="w-16 h-16 bg-gradient-to-r from-orange-500 to-red-600 rounded-2xl flex items-center justify-center mb-6">
                    <i class="fas fa-headset text-white text-2xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-slate-800 mb-4">24/7 Support</h3>
                <p class="text-slate-600 mb-6 leading-relaxed">
                    Round-the-clock customer support to assist you before, during, and after your stay.
                </p>
                <ul class="text-sm text-slate-500 space-y-2">
                    <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i>Live chat support</li>
                    <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i>Multi-language assistance</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- About Section -->
<section id="about" class="py-20 bg-gradient-to-br from-slate-900 via-blue-900 to-purple-900">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div class="text-white">
                <h2 class="text-4xl md:text-5xl font-bold mb-8">
                    Connecting Travelers with <span class="bg-gradient-to-r from-blue-400 to-purple-400 bg-clip-text text-transparent">Extraordinary Experiences</span>
                </h2>
                <p class="text-xl text-blue-100 mb-8 leading-relaxed">
                    BookingPlatform revolutionizes the way people discover and book unique accommodations. Our platform connects adventurous travelers with passionate hosts who offer authentic, memorable experiences.
                </p>
                <div class="grid grid-cols-2 gap-8 mb-8">
                    <div class="text-center">
                        <div class="text-3xl font-bold text-white mb-2">10K+</div>
                        <div class="text-blue-300">Happy Guests</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-white mb-2">5K+</div>
                        <div class="text-blue-300">Unique Properties</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-white mb-2">50+</div>
                        <div class="text-blue-300">Countries</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-white mb-2">4.9</div>
                        <div class="text-blue-300">Average Rating</div>
                    </div>
                </div>
                <a href="{{ route('register') }}" class="inline-flex items-center bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white px-8 py-4 rounded-xl font-semibold transition-all duration-300 shadow-lg hover:shadow-xl">
                    Join Our Community
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
            <div class="relative">
                <div class="bg-gradient-to-r from-blue-600/20 to-purple-600/20 rounded-3xl p-8 backdrop-blur-sm border border-white/10">
                    <img src="https://images.unsplash.com/photo-1560472354-b33ff0c44a43?w=600" alt="About Us" class="w-full h-96 object-cover rounded-2xl shadow-2xl">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section id="contact" class="py-20 bg-gradient-to-br from-slate-50 to-white">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-bold text-slate-800 mb-6">
                Get in Touch
            </h2>
            <p class="text-xl text-slate-600 max-w-3xl mx-auto">
                Have questions? We're here to help you plan your perfect getaway
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
            <!-- Contact Form -->
            <div class="bg-white rounded-3xl shadow-xl p-8 border border-slate-100">
                <h3 class="text-2xl font-bold text-slate-800 mb-6">Send us a Message</h3>
                <form class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">First Name</label>
                            <input type="text" class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Last Name</label>
                            <input type="text" class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Email</label>
                        <input type="email" class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Subject</label>
                        <select class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300">
                            <option>General Inquiry</option>
                            <option>Booking Support</option>
                            <option>Host Application</option>
                            <option>Technical Issue</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Message</label>
                        <textarea rows="5" class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 resize-none"></textarea>
                    </div>
                    <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white py-4 rounded-xl font-semibold transition-all duration-300 shadow-lg hover:shadow-xl">
                        Send Message
                    </button>
                </form>
            </div>

            <!-- Contact Info -->
            <div class="space-y-8">
                <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-3xl p-8 text-white">
                    <h3 class="text-2xl font-bold mb-6">Contact Information</h3>
                    <div class="space-y-6">
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-map-marker-alt text-xl"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold mb-1">Visit Us</h4>
                                <p class="text-blue-100">123 Booking Street<br>Suite 100, City, State 12345</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-phone text-xl"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold mb-1">Call Us</h4>
                                <p class="text-blue-100">+1 (555) 123-4567<br>Mon-Fri 9AM-6PM EST</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-envelope text-xl"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold mb-1">Email Us</h4>
                                <p class="text-blue-100">support@bookingplatform.com<br>We reply within 24 hours</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- FAQ Section -->
                <div class="bg-white rounded-3xl shadow-xl p-8 border border-slate-100">
                    <h3 class="text-2xl font-bold text-slate-800 mb-6">Frequently Asked Questions</h3>
                    <div class="space-y-4">
                        <div class="border-b border-slate-200 pb-4">
                            <h4 class="font-semibold text-slate-800 mb-2">How do I cancel my booking?</h4>
                            <p class="text-slate-600 text-sm">You can cancel your booking through your dashboard up to 24 hours before check-in.</p>
                        </div>
                        <div class="border-b border-slate-200 pb-4">
                            <h4 class="font-semibold text-slate-800 mb-2">Is my payment information secure?</h4>
                            <p class="text-slate-600 text-sm">Yes, we use industry-standard encryption and work with trusted payment processors.</p>
                        </div>
                        <div>
                            <h4 class="font-semibold text-slate-800 mb-2">How do I become a host?</h4>
                            <p class="text-slate-600 text-sm">Simply register as a Creator and start listing your property with our easy-to-use tools.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection