<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>JavaScript E-Learning Platform</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Roboto:wght@400;500&family=Oswald:wght@400;500&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-gray-50">
    <div class="min-h-screen flex">
        @include('components.sidebar')

        <div class="flex-1">
            <nav class="bg-[#375B5B] shadow-lg">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex items-center">
                            <a href="{{ url('/') }}" class="flex items-center">
                                <span class="text-white text-xl font-bold font-['Poppins']">Java<span class="text-[#3C8C4E]">Script</span></span>
                            </a>
                        </div>
                        <div class="flex items-center">
                            @if (Route::has('login'))
                                <div class="space-x-4">
                                    @auth
                                        <a href="{{ url('/dashboard') }}" class="text-white hover:text-[#3C8C4E] transition-colors duration-300 font-['Oswald']">Dashboard</a>
                                    @else
                                        <a href="{{ route('login') }}" class="text-white hover:text-[#3C8C4E] transition-colors duration-300 font-['Oswald']">Login</a>
                                        @if (Route::has('register'))
                                            <a href="{{ route('register') }}" class="ml-4 text-white hover:text-[#3C8C4E] transition-colors duration-300 font-['Oswald']">Register</a>
                                        @endif
                                    @endauth
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </nav>

            <main class="flex-1">
                @yield('content')
            </main>

            <footer class="bg-[#375B5B] text-white py-8 mt-12">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                    <p class="font-['Roboto']">&copy; {{ date('Y') }} JavaScript E-Learning Platform. All rights reserved.</p>
                </div>
            </footer>
        </div>
    </div>
</body>
</html>
