@extends('layouts.app')

@section('content')
<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-br from-[#D0F0C0] to-[#98FB98]">
    <!-- Logo -->
    <div class="mb-8">
        <h1 class="text-4xl font-bold font-['Poppins']">
            <span class="text-[#375B5B]">Java</span><span class="text-[#3C8C4E]">Script</span>
        </h1>
    </div>

    <div class="w-full sm:max-w-md px-8 py-8 bg-white shadow-xl rounded-xl">
        <h2 class="text-2xl font-bold mb-6 text-center text-[#375B5B] font-['Poppins']">Welcome Back!</h2>
        
        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            <div>
                <label for="email" class="block text-[#375B5B] font-['Montserrat'] font-semibold mb-2">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                    class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:outline-none focus:ring-2 focus:ring-[#3C8C4E] focus:border-transparent transition-all duration-300 font-['Roboto']"
                    placeholder="Enter your email">
                @error('email')
                    <p class="text-red-500 text-sm mt-1 font-['Roboto']">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-[#375B5B] font-['Montserrat'] font-semibold mb-2">Password</label>
                <input id="password" type="password" name="password" required
                    class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:outline-none focus:ring-2 focus:ring-[#3C8C4E] focus:border-transparent transition-all duration-300 font-['Roboto']"
                    placeholder="Enter your password">
                @error('password')
                    <p class="text-red-500 text-sm mt-1 font-['Roboto']">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center">
                <input type="checkbox" name="remember" id="remember"
                    class="rounded border-gray-300 text-[#3C8C4E] focus:ring-[#3C8C4E] transition-all duration-300">
                <label for="remember" class="ml-2 text-gray-600 font-['Roboto']">Remember me</label>
            </div>

            <div class="flex flex-col space-y-4 sm:flex-row sm:space-y-0 sm:justify-between sm:items-center">
                <a href="{{ route('register') }}" 
                   class="text-[#3C8C4E] hover:text-[#2D6B3B] font-['Roboto'] transition-colors duration-300">
                    Need an account?
                </a>
                <button type="submit" 
                        class="w-full sm:w-auto px-6 py-3 bg-[#3C8C4E] text-white rounded-lg hover:bg-[#2D6B3B] focus:outline-none focus:ring-2 focus:ring-[#2D6B3B] focus:ring-offset-2 transition-all duration-300 font-['Oswald'] text-lg">
                    Sign In
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
