@extends('layouts.app')

@section('content')
    <div class="bg-gradient-to-r from-[#D0F0C0] to-[#98FB98] shadow-lg rounded-lg">
        <div class="p-8">
            <h1 class="text-3xl font-bold mb-4 text-[#375B5B] font-['Poppins']">
                {{ $topic->title }}
            </h1>
            <h2 class="text-2xl text-[#2D6B3B] mb-6 font-['Montserrat']">
                {{ $subtopic->title }}
            </h2>
            
            <div class="prose max-w-none bg-white p-6 rounded-lg shadow-md">
                <div id="markdown-content" 
                     data-content="{{ htmlspecialchars($subtopic->content, ENT_QUOTES, 'UTF-8') }}"
                     class="font-['Roboto'] text-[#343A40] leading-relaxed min-h-[200px]">
                    <div class="animate-pulse">
                        Loading content...
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    @vite(['resources/js/markdown.js'])
@endpush
