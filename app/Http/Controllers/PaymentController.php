<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function razorpay(Request $request)
    {
        // Simulate Razorpay payment processing
        $paymentData = [
            'payment_id' => 'pay_razorpay_' . rand(10000, 99999),
            'amount' => $request->amount,
            'status' => 'completed',
            'method' => 'Razorpay'
        ];

        session(['payment_success' => $paymentData]);
        return redirect()->route('payment.success');
    }

    public function stripe(Request $request)
    {
        // Simulate Stripe payment processing
        $paymentData = [
            'payment_id' => 'pi_stripe_' . rand(10000, 99999),
            'amount' => $request->amount,
            'status' => 'completed',
            'method' => 'Stripe'
        ];

        session(['payment_success' => $paymentData]);
        return redirect()->route('payment.success');
    }

    public function success()
    {
        if (!session('user_logged_in') || !session('payment_success')) {
            return redirect()->route('home');
        }

        $paymentData = session('payment_success');
        $booking = session('pending_booking');

        // Clear session data
        session()->forget(['payment_success', 'pending_booking']);

        return view('payment.success', compact('paymentData', 'booking'));
    }
}