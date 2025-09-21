@extends('layouts.app')

@section('title', 'Register - BookingPlatform')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-green-900 via-teal-900 to-blue-900 flex items-center justify-center py-12 px-4">
    <div class="max-w-md w-full">
        <!-- Register Card -->
        <div class="bg-white/95 backdrop-blur-md rounded-3xl shadow-2xl p-8 border border-white/20">
            <div class="text-center mb-8">
                <div class="w-20 h-20 bg-gradient-to-r from-green-600 to-teal-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-user-plus text-white text-2xl"></i>
                </div>
                <h2 class="text-3xl font-bold text-slate-800">Create Account</h2>
                <p class="text-slate-600 mt-2">Join our community today</p>
            </div>

            <form action="{{ route('register') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Full Name</label>
                    <div class="relative">
                        <input type="text" name="name" required class="w-full px-4 py-3 pl-12 border border-slate-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-300" placeholder="Enter your full name">
                        <i class="fas fa-user absolute left-4 top-1/2 transform -translate-y-1/2 text-slate-400"></i>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Email Address</label>
                    <div class="relative">
                        <input type="email" name="email" required class="w-full px-4 py-3 pl-12 border border-slate-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-300" placeholder="Enter your email">
                        <i class="fas fa-envelope absolute left-4 top-1/2 transform -translate-y-1/2 text-slate-400"></i>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Password</label>
                    <div class="relative">
                        <input type="password" name="password" required class="w-full px-4 py-3 pl-12 pr-12 border border-slate-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-300" placeholder="Create a password">
                        <i class="fas fa-lock absolute left-4 top-1/2 transform -translate-y-1/2 text-slate-400"></i>
                        <button type="button" onclick="togglePassword()" class="absolute right-4 top-1/2 transform -translate-y-1/2 text-slate-400 hover:text-slate-600">
                            <i class="fas fa-eye" id="toggleIcon"></i>
                        </button>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Account Type</label>
                    <div class="grid grid-cols-2 gap-4">
                        <label class="relative cursor-pointer">
                            <input type="radio" name="role" value="EndUser" class="peer sr-only" required>
                            <div class="p-4 border-2 border-slate-300 rounded-xl peer-checked:border-green-500 peer-checked:bg-green-50 transition-all duration-300">
                                <div class="text-center">
                                    <i class="fas fa-user text-2xl text-slate-400 peer-checked:text-green-500 mb-2"></i>
                                    <div class="font-semibold text-slate-700">Traveler</div>
                                    <div class="text-xs text-slate-500">Book amazing places</div>
                                </div>
                            </div>
                        </label>
                        <label class="relative cursor-pointer">
                            <input type="radio" name="role" value="Creator" class="peer sr-only" required>
                            <div class="p-4 border-2 border-slate-300 rounded-xl peer-checked:border-green-500 peer-checked:bg-green-50 transition-all duration-300">
                                <div class="text-center">
                                    <i class="fas fa-home text-2xl text-slate-400 peer-checked:text-green-500 mb-2"></i>
                                    <div class="font-semibold text-slate-700">Host</div>
                                    <div class="text-xs text-slate-500">List your property</div>
                                </div>
                            </div>
                        </label>
                    </div>
                </div>

                <div class="flex items-center">
                    <input type="checkbox" required class="w-4 h-4 text-green-600 border-slate-300 rounded focus:ring-green-500">
                    <span class="ml-2 text-sm text-slate-600">
                        I agree to the <a href="#" class="text-green-600 hover:text-green-700 font-medium">Terms of Service</a> and <a href="#" class="text-green-600 hover:text-green-700 font-medium">Privacy Policy</a>
                    </span>
                </div>

                <button type="submit" class="w-full bg-gradient-to-r from-green-600 to-teal-600 hover:from-green-700 hover:to-teal-700 text-white py-3 rounded-xl font-semibold transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                    Create Account
                </button>
            </form>

            <div class="mt-8 text-center">
                <p class="text-slate-600">Already have an account? 
                    <a href="{{ route('login') }}" class="text-green-600 hover:text-green-700 font-semibold">Sign in</a>
                </p>
            </div>

            <!-- Social Register -->
            <div class="mt-8">
                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-slate-300"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-2 bg-white text-slate-500">Or register with</span>
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

// Add visual feedback for role selection
document.querySelectorAll('input[name="role"]').forEach(radio => {
    radio.addEventListener('change', function() {
        document.querySelectorAll('input[name="role"]').forEach(r => {
            const div = r.closest('label').querySelector('div');
            if (r.checked) {
                div.classList.add('border-green-500', 'bg-green-50');
                div.classList.remove('border-slate-300');
            } else {
                div.classList.remove('border-green-500', 'bg-green-50');
                div.classList.add('border-slate-300');
            }
        });
    });
});
</script>
@endsection