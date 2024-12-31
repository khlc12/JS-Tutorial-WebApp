<!-- Sidebar -->
<div class="bg-[#375B5B] w-64 min-h-screen text-white">
    <div class="p-4">
        <h1 class="text-2xl font-bold font-['Poppins'] text-white">Topics</h1>
    </div>
    <nav class="mt-4">
        <div class="px-4">
            @foreach($topics as $topic)
                <div class="mb-4">
                    <!-- Topic Header -->
                    <div class="flex items-center justify-between px-4 py-2 text-white hover:bg-[#3C8C4E] transition-colors duration-300 rounded-lg cursor-pointer"
                         onclick="toggleTopic('{{ $topic->id }}')">
                        <span class="text-lg font-['Poppins']">{{ $topic->title }}</span>
                        <i class="fas fa-chevron-down transform transition-transform duration-300" id="icon-{{ $topic->id }}"></i>
                    </div>
                    
                    <!-- Subtopics -->
                    <div class="hidden mt-2 ml-4 space-y-2" id="subtopics-{{ $topic->id }}">
                        @foreach($topic->subtopics as $subtopic)
                            <a href="{{ route('topics.show', ['topic' => $topic->slug, 'subtopic' => $subtopic->slug]) }}"
                               class="block px-4 py-2 text-gray-200 hover:text-white hover:bg-[#3C8C4E] transition-colors duration-300 rounded-lg font-['Roboto']">
                                {{ $subtopic->title }}
                            </a>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </nav>
</div>

<!-- Sidebar Toggle Script -->
<script>
function toggleTopic(topicId) {
    const subtopics = document.getElementById(`subtopics-${topicId}`);
    const icon = document.getElementById(`icon-${topicId}`);
    
    if (subtopics.classList.contains('hidden')) {
        subtopics.classList.remove('hidden');
        icon.classList.add('rotate-180');
    } else {
        subtopics.classList.add('hidden');
        icon.classList.remove('rotate-180');
    }
}
</script>
