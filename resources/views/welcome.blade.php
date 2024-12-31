@extends('layouts.welcome')

@section('content')
<div class="p-8">
    <!-- Welcome Banner -->
    <div class="bg-gradient-to-r from-[#D0F0C0] to-[#98FB98] shadow-lg rounded-lg p-8 mb-12">
        <h1 class="text-4xl font-bold mb-4 text-[#375B5B] font-['Poppins']">
            Welcome to <span class="text-[#2D6B3B]">JavaScript</span> E-Learning Platform
        </h1>
        <p class="text-[#375B5B] font-['Roboto'] text-xl">
            Select a topic from the sidebar to start learning. Each topic contains multiple subtopics that you can explore.
        </p>
    </div>

    <!-- Main Content Grid -->
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
        <!-- The Journey of JavaScript -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden transition-transform duration-300 hover:-translate-y-2">
            <div class="p-6">
                <div class="flex items-center mb-4">
                    <div class="bg-[#3C8C4E]/10 p-3 rounded-full mr-4">
                        <i class="fas fa-history text-[#3C8C4E] text-2xl"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-[#375B5B] font-['Poppins']">The Journey of JavaScript</h2>
                </div>
                <p class="text-gray-600 font-['Roboto'] leading-relaxed">
                    JavaScript was created in 1995 by Brendan Eich during his time at Netscape Communications. Initially developed in just 10 days, it has evolved from a simple scripting language into a powerful programming language that shapes the modern web. Today, JavaScript powers everything from interactive websites to server applications, making it one of the most versatile and widely-used programming languages in the world.
                </p>
            </div>
        </div>

        <!-- Why Learn JavaScript -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden transition-transform duration-300 hover:-translate-y-2">
            <div class="p-6">
                <div class="flex items-center mb-4">
                    <div class="bg-[#3C8C4E]/10 p-3 rounded-full mr-4">
                        <i class="fas fa-rocket text-[#3C8C4E] text-2xl"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-[#375B5B] font-['Poppins']">Why Learn JavaScript?</h2>
                </div>
                <p class="text-gray-600 font-['Roboto'] leading-relaxed mb-4">
                    JavaScript is essential in modern web development, offering endless possibilities for creating dynamic and interactive web applications. Its versatility and wide adoption make it a crucial skill for developers.
                </p>
                <ul class="space-y-2 text-gray-600 font-['Roboto']">
                    <li class="flex items-center">
                        <i class="fas fa-check text-[#3C8C4E] mr-2"></i>
                        Frontend Development: Create responsive and interactive user interfaces
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-check text-[#3C8C4E] mr-2"></i>
                        Backend Development: Build scalable server applications with Node.js
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-check text-[#3C8C4E] mr-2"></i>
                        Mobile Development: Create cross-platform mobile apps
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-check text-[#3C8C4E] mr-2"></i>
                        High Demand: One of the most sought-after programming skills
                    </li>
                </ul>
            </div>
        </div>

        <!-- Our Mission -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden transition-transform duration-300 hover:-translate-y-2">
            <div class="p-6">
                <div class="flex items-center mb-4">
                    <div class="bg-[#3C8C4E]/10 p-3 rounded-full mr-4">
                        <i class="fas fa-bullseye text-[#3C8C4E] text-2xl"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-[#375B5B] font-['Poppins']">Our Mission</h2>
                </div>
                <p class="text-gray-600 font-['Roboto'] leading-relaxed mb-4">
                    Our mission is to make JavaScript learning accessible, engaging, and practical for everyone. We believe in:
                </p>
                <ul class="space-y-2 text-gray-600 font-['Roboto']">
                    <li class="flex items-center">
                        <i class="fas fa-check text-[#3C8C4E] mr-2"></i>
                        Structured Learning: From basics to advanced concepts
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-check text-[#3C8C4E] mr-2"></i>
                        Practical Examples: Real-world applications and projects
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-check text-[#3C8C4E] mr-2"></i>
                        Interactive Learning: Hands-on coding exercises
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-check text-[#3C8C4E] mr-2"></i>
                        Community Support: Learn and grow together
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
