@extends('layouts.app')

@section('title', 'Login - BookingPlatform')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-900 via-purple-900 to-indigo-900 flex items-center justify-center py-12 px-4">
    <div class="max-w-md w-full">
        <!-- Login Card -->
        <div class="bg-white/95 backdrop-blur-md rounded-3xl shadow-2xl p-8 border border-white/20">
            <div class="text-center mb-8">
                <div class="w-20 h-20 bg-gradient-to-r from-blue-600 to-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-user text-white text-2xl"></i>
                </div>
                <h2 class="text-3xl font-bold text-slate-800">Welcome Back</h2>
                <p class="text-slate-600 mt-2">Sign in to your account</p>
            </div>

            @if(session('error'))
                <div class="bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded-xl mb-6">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Demo Credentials -->
            <div class="bg-gradient-to-r from-blue-50 to-purple-50 rounded-xl p-4 mb-6 border border-blue-200">
                <h3 class="font-semibold text-slate-800 mb-3 text-center">Demo Credentials</h3>
                <div class="space-y-2 text-sm">
                    <div class="flex justify-between items-center p-2 bg-white rounded-lg">
                        <span class="font-medium text-slate-700">SuperAdmin:</span>
                        <span class="text-slate-600">admin@booking.com / admin123</span>
                    </div>
                    <div class="flex justify-between items-center p-2 bg-white rounded-lg">
                        <span class="font-medium text-slate-700">Creator:</span>
                        <span class="text-slate-600">john@example.com / user123</span>
                    </div>
                    <div class="flex justify-between items-center p-2 bg-white rounded-lg">
                        <span class="font-medium text-slate-700">EndUser:</span>
                        <span class="text-slate-600">sarah@example.com / user123</span>
                    </div>
                </div>
            </div>

            <form action="{{ route('login') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Email Address</label>
                    <div class="relative">
                        <input type="email" name="email" required class="w-full px-4 py-3 pl-12 border border-slate-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300" placeholder="Enter your email">
                        <i class="fas fa-envelope absolute left-4 top-1/2 transform -translate-y-1/2 text-slate-400"></i>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Password</label>
                    <div class="relative">
                        <input type="password" name="password" required class="w-full px-4 py-3 pl-12 pr-12 border border-slate-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300" placeholder="Enter your password">
                        <i class="fas fa-lock absolute left-4 top-1/2 transform -translate-y-1/2 text-slate-400"></i>
                        <button type="button" onclick="togglePassword()" class="absolute right-4 top-1/2 transform -translate-y-1/2 text-slate-400 hover:text-slate-600">
                            <i class="fas fa-eye" id="toggleIcon"></i>
                        </button>
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <label class="flex items-center">
                        <input type="checkbox" class="w-4 h-4 text-blue-600 border-slate-300 rounded focus:ring-blue-500">
                        <span class="ml-2 text-sm text-slate-600">Remember me</span>
                    </label>
                    <a href="#" class="text-sm text-blue-600 hover:text-blue-700 font-medium">Forgot password?</a>
                </div>

                <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white py-3 rounded-xl font-semibold transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                    Sign In
                </button>
            </form>

            <div class="mt-8 text-center">
                <p class="text-slate-600">Don't have an account? 
                    <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-700 font-semibold">Sign up</a>
                </p>
            </div>

            <!-- Social Login -->
            <div class="mt-8">
                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-slate-300"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-2 bg-white text-slate-500">Or continue with</span>
                    </div>
                </div>

                <div class="mt-6 grid grid-cols-2 gap-3">
                    <button class="w-full inline-flex justify-center py-3 px-4 border border-slate-300 rounded-xl shadow-sm bg-white text-sm font-medium text-slate-500 hover:bg-slate-50 transition-colors duration-300">
                        <i class="fab fa-google text-red-500 text-lg"></i>
                        <span class="ml-2">Google</span>
                    </button>
                    <button class="w-full inline-flex justify-center py-3 px-4 border border-slate-300 rounded-xl shadow-sm bg-white text-sm font-medium text-slate-500 hover:bg-slate-50 transition-colors duration-300">
                        <i class="fab fa-facebook text-blue-600 text-lg"></i>
                        <span class="ml-2">Facebook</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function togglePassword() {
    const passwordInput = document.querySelector('input[name="password"]');
    const toggleIcon = document.getElementById('toggleIcon');
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleIcon.classList.remove('fa-eye');
        toggleIcon.classList.add('fa-eye-slash');
    } else {
        passwordInput.type = 'password';
        toggleIcon.classList.remove('fa-eye-slash');
        toggleIcon.classList.add('fa-eye');
    }
}
</script>
@endsection