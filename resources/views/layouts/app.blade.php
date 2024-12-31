<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'JSAcademy') }}</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    <meta name="theme-color" content="#3C8C4E">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Additional CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Modern color theme */
        body {
            background-color: #f0f4f8;
            color: #333;
        }
        .bg-white {
            background-color: #ffffff;
        }
        .text-xl {
            color: #007acc;
        }
        .hover\:bg-gray-100:hover {
            background-color: #e0f7fa;
        }
        /* Hover effects */
        button:hover {
            transform: scale(1.05);
            transition: transform 0.2s ease-in-out;
        }
        /* Dark mode toggle (optional) */
        .dark-mode body {
            background-color: #1e1e1e;
            color: #cfcfcf;
        }
        .dark-mode .bg-white {
            background-color: #2e2e2e;
        }
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
<body class="font-sans antialiased min-h-full">
    <div class="min-h-full">
        @include('layouts.navigation')

        <div class="flex min-h-[calc(100vh-4rem)]"> <!-- Subtract navbar height -->
            @include('layouts.sidebar')
            
            <!-- Main Content -->
            <main class="flex-1 p-8 bg-gray-50">
                @yield('content')
            </main>
        </div>
    </div>

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

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
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
    
    @stack('scripts')
</body>
</html>
