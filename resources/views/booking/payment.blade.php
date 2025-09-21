@extends('layouts.app')

@section('title', 'Payment - BookingPlatform')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50 py-8">
    <div class="max-w-4xl mx-auto px-4">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-slate-800 mb-2">Complete Your Booking</h1>
            <p class="text-slate-600">Choose your preferred payment method</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Payment Methods -->
            <div class="bg-white/80 backdrop-blur-md rounded-3xl shadow-xl p-8 border border-white/50">
                <h2 class="text-2xl font-bold text-slate-800 mb-6">Payment Methods</h2>

                <!-- Razorpay Payment -->
                <div class="mb-6">
                    <div class="border-2 border-slate-200 rounded-2xl p-6 hover:border-blue-500 transition-colors duration-300">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-12 h-12 bg-gradient-to-r from-blue-600 to-blue-800 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-credit-card text-white"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-slate-800">Razorpay</h3>
                                    <p class="text-sm text-slate-600">Credit/Debit Card, UPI, Net Banking</p>
                                </div>
                            </div>
                            <div class="flex space-x-2">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/8/89/Razorpay_logo.svg" alt="Razorpay" class="h-6">
                            </div>
                        </div>
                        <form action="{{ route('payment.razorpay') }}" method="POST">
                            @csrf
                            <input type="hidden" name="amount" value="{{ $booking['total_amount'] }}">
                            <input type="hidden" name="booking_id" value="{{ $booking['id'] }}">
                            <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-blue-800 hover:from-blue-700 hover:to-blue-900 text-white py-3 rounded-xl font-semibold transition-all duration-300">
                                Pay with Razorpay
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Stripe Payment -->
                <div class="mb-6">
                    <div class="border-2 border-slate-200 rounded-2xl p-6 hover:border-purple-500 transition-colors duration-300">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-12 h-12 bg-gradient-to-r from-purple-600 to-purple-800 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-lock text-white"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-slate-800">Stripe</h3>
                                    <p class="text-sm text-slate-600">Secure international payments</p>
                                </div>
                            </div>
                            <div class="flex space-x-2">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/b/ba/Stripe_Logo%2C_revised_2016.svg" alt="Stripe" class="h-6">
                            </div>
                        </div>
                        <form action="{{ route('payment.stripe') }}" method="POST">
                            @csrf
                            <input type="hidden" name="amount" value="{{ $booking['total_amount'] }}">
                            <input type="hidden" name="booking_id" value="{{ $booking['id'] }}">
                            <button type="submit" class="w-full bg-gradient-to-r from-purple-600 to-purple-800 hover:from-purple-700 hover:to-purple-900 text-white py-3 rounded-xl font-semibold transition-all duration-300">
                                Pay with Stripe
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Security Info -->
                <div class="bg-gradient-to-r from-green-50 to-teal-50 rounded-2xl p-4 border border-green-200">
                    <div class="flex items-start space-x-3">
                        <i class="fas fa-shield-alt text-green-600 mt-1"></i>
                        <div>
                            <h4 class="font-semibold text-green-800 mb-1">Secure Payment</h4>
                            <p class="text-sm text-green-700">Your payment information is protected with bank-level security and encryption.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Booking Summary -->
            <div class="bg-white/80 backdrop-blur-md rounded-3xl shadow-xl p-8 border border-white/50">
                <h2 class="text-2xl font-bold text-slate-800 mb-6">Booking Summary</h2>

                <!-- Booking Details -->
                <div class="space-y-4 mb-6">
                    <div class="flex justify-between">
                        <span class="text-slate-600">Booking ID</span>
                        <span class="font-semibold text-slate-800">#{{ $booking['id'] }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-slate-600">Check In</span>
                        <span class="font-semibold text-slate-800">{{ $booking['check_in'] }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-slate-600">Check Out</span>
                        <span class="font-semibold text-slate-800">{{ $booking['check_out'] }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-slate-600">Guest</span>
                        <span class="font-semibold text-slate-800">{{ session('user')['name'] }}</span>
                    </div>
                </div>

                <!-- Pricing Breakdown -->
                <div class="border-t border-slate-200 pt-6 mb-6">
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-slate-600">Subtotal</span>
                            <span class="text-slate-800">${{ $booking['total_amount'] - round($booking['total_amount'] * 0.15) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-slate-600">Service fee</span>
                            <span class="text-slate-800">${{ round($booking['total_amount'] * 0.15) }}</span>
                        </div>
                        <div class="border-t border-slate-200 pt-3">
                            <div class="flex justify-between font-bold text-xl">
                                <span class="text-slate-800">Total</span>
                                <span class="text-slate-800">${{ $booking['total_amount'] }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Cancellation Policy -->
                <div class="bg-gradient-to-r from-orange-50 to-red-50 rounded-2xl p-4 border border-orange-200">
                    <h4 class="font-semibold text-orange-800 mb-2">Cancellation Policy</h4>
                    <p class="text-sm text-orange-700">Free cancellation until 24 hours before check-in. After that, you'll be charged the first night.</p>
                </div>

                <!-- Contact Support -->
                <div class="mt-6 text-center">
                    <p class="text-sm text-slate-600 mb-2">Need help?</p>
                    <a href="#" class="text-blue-600 hover:text-blue-700 font-medium">Contact Support</a>
                </div>
            </div>
        </div>

        <!-- Back Button -->
        <div class="text-center mt-8">
            <a href="{{ route('enduser.listings') }}" class="inline-flex items-center text-slate-600 hover:text-blue-600 transition-colors duration-300">
                <i class="fas fa-arrow-left mr-2"></i>
                Back to Listings
            </a>
        </div>
    </div>
</div>
@endsection