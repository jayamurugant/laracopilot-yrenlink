<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'BookingPlatform - Your Premier Booking Experience')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
</head>
<body class="bg-gradient-to-br from-slate-50 to-white">
    <!-- Navigation Header -->
    <nav class="bg-white/95 backdrop-blur-md shadow-lg border-b border-slate-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gradient-to-r from-blue-600 to-purple-600 rounded-xl flex items-center justify-center">
                        <i class="fas fa-home text-white text-lg"></i>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                            BookingPlatform
                        </h1>
                        <p class="text-xs text-slate-500">Premium Booking Experience</p>
                    </div>
                </div>

                <!-- Navigation Links -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="/" class="text-slate-700 hover:text-blue-600 font-medium transition-colors duration-300">Home</a>
                    <a href="#listings" class="text-slate-700 hover:text-blue-600 font-medium transition-colors duration-300">Listings</a>
                    <a href="#about" class="text-slate-700 hover:text-blue-600 font-medium transition-colors duration-300">About</a>
                    <a href="#contact" class="text-slate-700 hover:text-blue-600 font-medium transition-colors duration-300">Contact</a>
                </div>

                <!-- Auth Buttons -->
                <div class="flex items-center space-x-4">
                    @if(session('user_logged_in'))
                        <div class="flex items-center space-x-4">
                            <div class="text-sm">
                                <span class="text-slate-600">Welcome,</span>
                                <span class="font-semibold text-slate-800">{{ session('user')['name'] }}</span>
                            </div>
                            @if(session('user')['role'] === 'SuperAdmin')
                                <a href="{{ route('superadmin.dashboard') }}" class="bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white px-4 py-2 rounded-lg font-medium transition-all duration-300">
                                    Admin Panel
                                </a>
                            @elseif(session('user')['role'] === 'Creator')
                                <a href="{{ route('creator.dashboard') }}" class="bg-gradient-to-r from-green-600 to-teal-600 hover:from-green-700 hover:to-teal-700 text-white px-4 py-2 rounded-lg font-medium transition-all duration-300">
                                    Creator Dashboard
                                </a>
                            @else
                                <a href="{{ route('enduser.dashboard') }}" class="bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white px-4 py-2 rounded-lg font-medium transition-all duration-300">
                                    My Dashboard
                                </a>
                            @endif
                            <form action="{{ route('logout') }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="text-slate-600 hover:text-red-600 transition-colors duration-300">
                                    <i class="fas fa-sign-out-alt"></i>
                                </button>
                            </form>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="text-slate-700 hover:text-blue-600 font-medium transition-colors duration-300">Login</a>
                        <a href="{{ route('register') }}" class="bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white px-6 py-2 rounded-lg font-medium transition-all duration-300 shadow-lg hover:shadow-xl">
                            Register
                        </a>
                    @endif
                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden">
                    <button id="mobile-menu-btn" class="text-slate-700 hover:text-blue-600 transition-colors duration-300">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-white border-t border-slate-200">
            <div class="px-4 py-4 space-y-3">
                <a href="/" class="block text-slate-700 hover:text-blue-600 font-medium py-2">Home</a>
                <a href="#listings" class="block text-slate-700 hover:text-blue-600 font-medium py-2">Listings</a>
                <a href="#about" class="block text-slate-700 hover:text-blue-600 font-medium py-2">About</a>
                <a href="#contact" class="block text-slate-700 hover:text-blue-600 font-medium py-2">Contact</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-slate-900 text-white py-16">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-8">
                <!-- Company Info -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">BookingPlatform</h3>
                    <p class="text-slate-300 text-sm mb-4 leading-relaxed">
                        Your premier destination for unique accommodations and experiences. Connect with amazing hosts and discover extraordinary places.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="w-10 h-10 bg-slate-800 hover:bg-blue-600 rounded-lg flex items-center justify-center transition-colors duration-300">
                            <i class="fab fa-facebook-f text-sm"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-slate-800 hover:bg-blue-400 rounded-lg flex items-center justify-center transition-colors duration-300">
                            <i class="fab fa-twitter text-sm"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-slate-800 hover:bg-pink-600 rounded-lg flex items-center justify-center transition-colors duration-300">
                            <i class="fab fa-instagram text-sm"></i>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">Quick Links</h3>
                    <ul class="space-y-2">
                        <li><a href="/" class="text-slate-300 hover:text-white transition-colors duration-300 text-sm">Home</a></li>
                        <li><a href="#listings" class="text-slate-300 hover:text-white transition-colors duration-300 text-sm">Browse Listings</a></li>
                        <li><a href="{{ route('register') }}" class="text-slate-300 hover:text-white transition-colors duration-300 text-sm">Become a Host</a></li>
                        <li><a href="#" class="text-slate-300 hover:text-white transition-colors duration-300 text-sm">Help Center</a></li>
                    </ul>
                </div>

                <!-- For Hosts -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">For Hosts</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('register') }}" class="text-slate-300 hover:text-white transition-colors duration-300 text-sm">Start Hosting</a></li>
                        <li><a href="#" class="text-slate-300 hover:text-white transition-colors duration-300 text-sm">Host Resources</a></li>
                        <li><a href="#" class="text-slate-300 hover:text-white transition-colors duration-300 text-sm">Community Forum</a></li>
                        <li><a href="#" class="text-slate-300 hover:text-white transition-colors duration-300 text-sm">Host Protection</a></li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">Contact Info</h3>
                    <div class="space-y-3">
                        <div class="flex items-start space-x-3">
                            <i class="fas fa-map-marker-alt text-slate-400 mt-1"></i>
                            <div>
                                <p class="text-slate-300 text-sm">123 Booking Street</p>
                                <p class="text-slate-300 text-sm">Suite 100, City, State 12345</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-phone text-slate-400"></i>
                            <p class="text-slate-300 text-sm">+1 (555) 123-4567</p>
                        </div>
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-envelope text-slate-400"></i>
                            <p class="text-slate-300 text-sm">support@bookingplatform.com</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="border-t border-slate-700 pt-8">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <div class="text-sm text-slate-400 mb-4 md:mb-0">
                        © {{ date('Y') }} BookingPlatform. All rights reserved.
                    </div>
                    <div class="flex space-x-6 mb-4 md:mb-0">
                        <a href="#" class="text-slate-400 hover:text-white transition-colors duration-300 text-sm">Privacy Policy</a>
                        <a href="#" class="text-slate-400 hover:text-white transition-colors duration-300 text-sm">Terms of Service</a>
                    </div>
                    <div class="text-sm text-slate-400">
                        Made with ❤️ <span class="text-white font-medium">LaraCopilot</span>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Mobile menu toggle
        $('#mobile-menu-btn').click(function() {
            $('#mobile-menu').toggleClass('hidden');
        });

        // Smooth scrolling for anchor links
        $('a[href^="#"]').on('click', function(event) {
            var target = $(this.getAttribute('href'));
            if( target.length ) {
                event.preventDefault();
                $('html, body').stop().animate({
                    scrollTop: target.offset().top - 80
                }, 1000);
            }
        });
    </script>
</body>
</html>