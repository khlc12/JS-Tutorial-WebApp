@extends('layouts.app')

@section('content')
    <div class="bg-gradient-to-r from-[#D0F0C0] to-[#98FB98] shadow-lg rounded-lg p-8">
        <h1 class="text-3xl font-bold mb-4 text-[#375B5B] font-['Poppins']">
            Welcome to <span class="text-[#2D6B3B]">JavaScript</span> E-Learning Platform
        </h1>
        <p class="text-[#375B5B] font-['Roboto'] text-lg">
            Select a topic from the sidebar to start learning. Each topic contains multiple subtopics that you can explore.
        </p>
    </div>

    @auth
        <!-- Admin Controls -->
        <div class="mt-8 bg-white shadow-lg rounded-lg p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold text-[#375B5B] font-['Poppins']">Admin Controls</h2>
                <button onclick="openAddTopicModal()" 
                        class="bg-[#3C8C4E] text-white px-4 py-2 rounded hover:bg-[#2D6B3B] transition-colors duration-300 font-['Oswald']">
                    Add New Topic
                </button>
            </div>

            <!-- Topics List -->
            <div class="space-y-4">
                @foreach($topics as $topic)
                    <div class="border rounded p-4 flex justify-between items-center">
                        <div>
                            <h3 class="text-lg font-semibold text-[#2F4F4F] font-['Poppins']">{{ $topic->title }}</h3>
                            <p class="text-gray-600 font-['Roboto']">{{ count($topic->subtopics) }} subtopics</p>
                        </div>
                        <form action="{{ route('topics.destroy', $topic) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition-colors duration-300 font-['Oswald']">
                                Delete
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Add Topic Modal -->
        <div id="addTopicModal" class="fixed inset-0 bg-black bg-opacity-50 hidden">
            <div class="fixed inset-0 flex items-center justify-center">
                <div class="bg-white rounded-lg p-8 max-w-md w-full">
                    <h2 class="text-2xl font-bold mb-4 text-[#2F4F4F] font-['Poppins']">Add New Topic</h2>
                    <form action="{{ route('topics.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2 font-['Roboto']" for="title">
                                Topic Title
                            </label>
                            <input type="text" name="title" id="title" required
                                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>
                        
                        <div id="subtopicsContainer">
                            <!-- Subtopic fields will be added here -->
                        </div>

                        <div class="flex justify-between mt-4">
                            <button type="button" onclick="addSubtopicField()"
                                    class="bg-[#28A745] text-white px-4 py-2 rounded hover:bg-[#218838] transition-colors duration-300 font-['Oswald']">
                                Add Subtopic
                            </button>
                            <div>
                                <button type="button" onclick="document.getElementById('addTopicModal').classList.add('hidden')"
                                        class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition-colors duration-300 font-['Oswald'] mr-2">
                                    Cancel
                                </button>
                                <button type="submit"
                                        class="bg-[#28A745] text-white px-4 py-2 rounded hover:bg-[#218838] transition-colors duration-300 font-['Oswald']">
                                    Save Topic
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script>
            let subtopicCount = 0;

            function addSubtopicField() {
                const container = document.getElementById('subtopicsContainer');
                const field = document.createElement('div');
                field.className = 'mb-4';
                field.innerHTML = `
                    <label class="block text-gray-700 text-sm font-bold mb-2 font-['Roboto']">
                        Subtopic ${subtopicCount + 1}
                    </label>
                    <div class="flex gap-2">
                        <input type="text" name="subtopics[]" required
                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <button type="button" onclick="this.parentElement.parentElement.remove()"
                                class="bg-red-500 text-white px-3 rounded hover:bg-red-600 transition-colors duration-300 font-['Oswald']">
                            Remove
                        </button>
                    </div>
                `;
                container.appendChild(field);
                subtopicCount++;
            }
        </script>
    @endauth
@endsection
