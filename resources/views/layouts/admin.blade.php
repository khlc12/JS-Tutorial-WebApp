<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin Dashboard - {{ config('app.name', 'JavaScript E-Learning') }}</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Additional CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Toast animation */
        @keyframes slideIn {
            from { transform: translateY(100%); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        @keyframes slideOut {
            from { transform: translateY(0); opacity: 1; }
            to { transform: translateY(100%); opacity: 0; }
        }
        .toast-enter {
            animation: slideIn 0.3s ease-out forwards;
        }
        .toast-exit {
            animation: slideOut 0.3s ease-out forwards;
        }
    </style>
</head>
<body class="font-sans antialiased h-full bg-gray-50">
    <!-- Top Navigation Bar -->
    <nav class="bg-[#375B5B] shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <h1 class="text-2xl font-bold font-['Poppins']">
                        <span class="text-white">Java</span><span class="text-[#98FB98]">Script</span>
                    </h1>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-white font-['Roboto']">Welcome, Admin</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="bg-[#2D6B3B] text-white px-4 py-2 rounded-lg hover:bg-[#1a4c2a] transition-all duration-300 font-['Oswald']">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @yield('content')
    </main>

    <!-- Toast Messages -->
    <div id="toast-container" class="fixed bottom-4 right-4 z-50">
        @if (session('success'))
            <div class="toast-message bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg mb-2 hidden">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="toast-message bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg mb-2 hidden">
                {{ session('error') }}
            </div>
        @endif
    </div>

    <script>
        // Toast message handling
        document.addEventListener('DOMContentLoaded', function() {
            const toastMessages = document.querySelectorAll('.toast-message');
            
            toastMessages.forEach(toast => {
                if (toast.textContent.trim()) {
                    // Show toast
                    toast.classList.remove('hidden');
                    toast.classList.add('toast-enter');
                    
                    // Remove toast after delay
                    setTimeout(() => {
                        toast.classList.remove('toast-enter');
                        toast.classList.add('toast-exit');
                        
                        // Remove element after animation
                        toast.addEventListener('animationend', () => {
                            toast.remove();
                        }, { once: true });
                    }, 3000);
                }
            });
        });
    </script>
</body>
</html>
