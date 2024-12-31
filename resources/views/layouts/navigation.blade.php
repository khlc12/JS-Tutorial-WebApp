<nav class="bg-[#375B5B] border-b border-[#2D6B3B]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('topics.index') }}" class="text-2xl font-bold font-['Poppins'] group transition-colors duration-300">
                        <span class="text-white group-hover:text-[#98FB98]">Java</span><span class="text-[#98FB98] group-hover:text-white">Script</span>
                    </a>
                </div>
            </div>

            <div class="flex items-center">
                @auth
                    <span class="text-white mr-4 font-['Roboto']">Welcome, {{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="bg-[#3C8C4E] text-white px-4 py-2 rounded hover:bg-[#2D6B3B] transition-colors duration-300 font-['Oswald']">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="bg-[#3C8C4E] text-white px-4 py-2 rounded hover:bg-[#2D6B3B] transition-colors duration-300 font-['Oswald']">Login</a>
                @endauth
            </div>
        </div>
    </div>
</nav>
