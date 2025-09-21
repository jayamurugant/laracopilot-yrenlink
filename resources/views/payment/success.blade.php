@extends('layouts.app')

@section('title', 'Payment Successful - BookingPlatform')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-green-50 to-teal-50 flex items-center justify-center py-12 px-4">
    <div class="max-w-2xl w-full">
        <!-- Success Card -->
        <div class="bg-white/95 backdrop-blur-md rounded-3xl shadow-2xl p-8 border border-white/20 text-center">
            <!-- Success Icon -->
            <div class="w-24 h-24 bg-gradient-to-r from-green-500 to-teal-600 rounded-full flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-check text-white text-3xl"></i>
            </div>

            <h1 class="text-4xl font-bold text-slate-800 mb-4">Payment Successful!</h1>
            <p class="text-xl text-slate-600 mb-8">Your booking has been confirmed</p>

            <!-- Payment Details -->
            <div class="bg-gradient-to-r from-green-50 to-teal-50 rounded-2xl p-6 mb-8 border border-green-200">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-left">
                    <div>
                        <p class="text-sm text-slate-600">Transaction ID</p>
                        <p class="font-semibold text-slate-800">{{ $paymentData['payment_id'] }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-slate-600">Payment Method</p>
                        <p class="font-semibold text-slate-800">{{ $paymentData['method'] }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-slate-600">Amount Paid</p>
                        <p class="font-semibold text-slate-800">${{ $paymentData['amount'] }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-slate-600">Status</p>
                        <p class="font-semibold text-green-600">{{ ucfirst($paymentData['status']) }}</p>
                    </div>
                </div>
            </div>

            <!-- Booking Details -->
            <div class="bg-slate-50 rounded-2xl p-6 mb-8 text-left">
                <h3 class="text-lg font-semibold text-slate-800 mb-4">Booking Details</h3>
                <div class="space-y-2">
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
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('enduser.bookings') }}" class="bg-gradient-to-r from-green-600 to-teal-600 hover:from-green-700 hover:to-teal-700 text-white px-8 py-3 rounded-xl font-semibold transition-all duration-300 shadow-lg hover:shadow-xl">
                    View My Bookings
                </a>
                <a href="{{ route('enduser.dashboard') }}" class="bg-white border border-slate-300 hover:bg-slate-50 text-slate-700 px-8 py-3 rounded-xl font-semibold transition-all duration-300">
                    Go to Dashboard
                </a>
            </div>

            <!-- Email Confirmation -->
            <div class="mt-8 p-4 bg-blue-50 rounded-xl border border-blue-200">
                <p class="text-sm text-blue-700">
                    <i class="fas fa-envelope mr-2"></i>
                    A confirmation email has been sent to your registered email address
                </p>
            </div>
        </div>
    </div>
</div>
@endsection