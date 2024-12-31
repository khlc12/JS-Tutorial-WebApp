@extends('layouts.admin')

@section('content')
    <!-- Dashboard Overview -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-lg font-semibold text-[#375B5B] font-['Poppins'] mb-2">Total Topics</h3>
            <p class="text-3xl font-bold text-[#3C8C4E]">{{ $topics->count() }}</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-lg font-semibold text-[#375B5B] font-['Poppins'] mb-2">Total Subtopics</h3>
            <p class="text-3xl font-bold text-[#3C8C4E]">{{ $topics->sum(function($topic) { return $topic->subtopics->count(); }) }}</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-lg font-semibold text-[#375B5B] font-['Poppins'] mb-2">Last Updated</h3>
            <p class="text-lg text-[#3C8C4E] font-['Roboto']">
                @if($topics->count() > 0 && $topics->max('updated_at'))
                    {{ $topics->max('updated_at')->diffForHumans() }}
                @else
                    No topics yet
                @endif
            </p>
        </div>
    </div>

    <!-- Topic Management -->
    <div class="bg-white rounded-lg shadow-md">
        <div class="p-6 border-b border-gray-200">
            <div class="flex justify-between items-center">
                <h2 class="text-2xl font-bold text-[#375B5B] font-['Poppins']">Topic Management</h2>
                <div class="flex justify-end">
                    <button onclick="openAddTopicModal()" 
                            class="bg-[#3C8C4E] text-white px-6 py-2 rounded-lg hover:bg-[#2D6B3B] transition-all duration-300 font-['Oswald']">
                        <i class="fas fa-plus mr-2"></i> Add Topic
                    </button>
                </div>
            </div>
            
            <!-- Search and Filter -->
            <div class="mt-4 flex gap-4">
                <div class="flex-1">
                    <input type="text" 
                           id="topicSearch"
                           placeholder="Search topics..." 
                           class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:outline-none focus:ring-2 focus:ring-[#3C8C4E] font-['Roboto']">
                </div>
                <select id="topicFilter"
                        class="px-4 py-2 rounded-lg border border-gray-200 focus:outline-none focus:ring-2 focus:ring-[#3C8C4E] font-['Roboto']">
                    <option value="">All Topics</option>
                    <option value="with_subtopics">With Subtopics</option>
                    <option value="without_subtopics">Without Subtopics</option>
                </select>
            </div>
        </div>

        <!-- Topics List -->
        <div class="p-6">
            <div class="space-y-4" id="topicsList">
                @forelse($topics as $topic)
                    <div class="border rounded-lg p-4 hover:shadow-md transition-shadow duration-300 topic-item" 
                         data-topic-id="{{ $topic->id }}"
                         data-subtopics-count="{{ $topic->subtopics->count() }}">
                        <div class="flex justify-between items-center">
                            <div>
                                <h3 class="text-lg font-semibold text-[#375B5B] font-['Poppins'] topic-title">{{ $topic->title }}</h3>
                                <p class="text-gray-600 font-['Roboto']">{{ $topic->subtopics->count() }} subtopics</p>
                            </div>
                            <div>
                                <button type="button" 
                                        class="text-red-500 hover:text-red-600 transition-colors duration-300"
                                        onclick="confirmDelete({{ $topic->id }})">
                                    <i class="fas fa-trash text-xl"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-8 text-gray-500 font-['Roboto']">
                        No topics found. Click "Add Topic" to create one.
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    @include('admin.partials.topic-modal')
    @include('admin.partials.confirm-delete-modal')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Search and Filter functionality
            const topicSearch = document.getElementById('topicSearch');
            const topicFilter = document.getElementById('topicFilter');
            
            function filterTopics() {
                const searchTerm = topicSearch.value.toLowerCase();
                const filterValue = topicFilter.value;
                const topics = document.querySelectorAll('.topic-item');
                
                topics.forEach(topic => {
                    const title = topic.querySelector('.topic-title').textContent.toLowerCase();
                    const subtopicsCount = parseInt(topic.dataset.subtopicsCount);
                    let show = title.includes(searchTerm);
                    
                    if (show && filterValue === 'with_subtopics') {
                        show = subtopicsCount > 0;
                    } else if (show && filterValue === 'without_subtopics') {
                        show = subtopicsCount === 0;
                    }
                    
                    topic.style.display = show ? 'block' : 'none';
                });
            }

            topicSearch.addEventListener('input', filterTopics);
            topicFilter.addEventListener('change', filterTopics);

            // Add Topic Modal Functions
            window.openAddTopicModal = function() {
                document.getElementById('topicModal').classList.remove('hidden');
                document.getElementById('topicForm').reset();
                const fileNames = document.querySelectorAll('.file-name');
                fileNames.forEach(span => span.textContent = 'No file chosen');
            }

            window.closeAddTopicModal = function() {
                document.getElementById('topicModal').classList.add('hidden');
            }

            window.updateFileName = function(input) {
                const fileName = input.files[0]?.name || 'No file chosen';
                input.closest('.relative').querySelector('.file-name').textContent = fileName;
            }

            let subtopicCounter = 1;
            window.addSubtopic = function() {
                const container = document.getElementById('subtopicsContainer');
                const newSubtopic = document.createElement('div');
                newSubtopic.className = 'subtopic-entry bg-gray-50 p-4 rounded-lg';
                newSubtopic.innerHTML = `
                    <div class="flex gap-4 mb-3">
                        <div class="flex-1">
                            <label class="block text-sm text-gray-600 mb-1">Subtopic Title</label>
                            <input type="text" 
                                   name="subtopics[${subtopicCounter}][title]" 
                                   required
                                   class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:outline-none focus:ring-2 focus:ring-[#3C8C4E] font-['Roboto']"
                                   placeholder="Enter subtopic title">
                        </div>
                        <button type="button" 
                                onclick="removeSubtopic(this)"
                                class="text-red-500 hover:text-red-600 self-end mb-1">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                    <div>
                        <label class="block text-sm text-gray-600 mb-1">Content File</label>
                        <p class="text-xs text-gray-500 mb-2">Upload a text file containing the content (Supported formats: .txt, .md)</p>
                        <div class="relative">
                            <input type="file" 
                                   name="subtopics[${subtopicCounter}][content_file]"
                                   accept=".txt,.md"
                                   required
                                   class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10"
                                   onchange="updateFileName(this)">
                            <div class="bg-white border border-gray-200 rounded-lg px-4 py-2 w-full flex items-center">
                                <span class="flex-1 text-gray-500 truncate file-name">No file chosen</span>
                                <span class="ml-2 px-4 py-1 bg-[#3C8C4E] text-white rounded font-['Oswald'] hover:bg-[#2D6B3B] transition-colors duration-300">
                                    Choose File
                                </span>
                            </div>
                        </div>
                    </div>
                `;
                container.appendChild(newSubtopic);
                subtopicCounter++;
            }

            window.removeSubtopic = function(button) {
                button.closest('.subtopic-entry').remove();
            }

            // Delete Topic Functions
            window.confirmDelete = function(topicId) {
                const form = document.getElementById('deleteTopicForm');
                form.action = `{{ url('/topics') }}/${topicId}`;
                document.getElementById('confirmDeleteModal').classList.remove('hidden');
            }

            window.closeDeleteModal = function() {
                document.getElementById('confirmDeleteModal').classList.add('hidden');
            }
        });
    </script>
@endsection
