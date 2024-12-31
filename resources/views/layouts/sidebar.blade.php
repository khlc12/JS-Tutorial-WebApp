<!-- Sidebar -->
<div class="w-64 bg-[#375B5B] text-white p-6">
    <h2 class="text-2xl font-bold mb-6 text-[#98FB98] font-['Poppins']">Topics</h2>
    
    <div class="space-y-2">
        @foreach($topics as $topic)
            <div class="mb-4">
                <div class="flex items-center justify-between cursor-pointer" 
                     onclick="toggleSubtopics('{{ $topic->slug }}')">
                    <span class="text-lg font-semibold font-['Montserrat']">{{ $topic->title }}</span>
                    <i class="fas fa-chevron-down transition-transform" id="icon-{{ $topic->slug }}"></i>
                </div>
                
                <div class="pl-4 mt-2 space-y-2 hidden" id="subtopics-{{ $topic->slug }}">
                    @foreach($topic->subtopics->sortBy('order') as $subtopic)
                        <a href="{{ route('topics.show', ['topic' => $topic->slug, 'subtopic' => $subtopic->slug]) }}"
                           class="block py-1 px-2 rounded hover:bg-[#2D6B3B] transition-colors duration-200 font-['Roboto']
                                  {{ request()->is('topics/'.$topic->slug.'/'.$subtopic->slug) ? 'bg-[#2D6B3B]' : '' }}">
                            {{ $subtopic->title }}
                        </a>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</div>

@push('scripts')
<script>
function toggleSubtopics(topicSlug) {
    const subtopicsDiv = document.getElementById(`subtopics-${topicSlug}`);
    const icon = document.getElementById(`icon-${topicSlug}`);
    
    if (subtopicsDiv.classList.contains('hidden')) {
        subtopicsDiv.classList.remove('hidden');
        icon.style.transform = 'rotate(180deg)';
    } else {
        subtopicsDiv.classList.add('hidden');
        icon.style.transform = 'rotate(0deg)';
    }
}

// Show active topic's subtopics on page load
document.addEventListener('DOMContentLoaded', function() {
    const currentPath = window.location.pathname;
    const match = currentPath.match(/^\/topics\/([^\/]+)/);
    if (match) {
        const currentTopicSlug = match[1];
        const subtopicsDiv = document.getElementById(`subtopics-${currentTopicSlug}`);
        const icon = document.getElementById(`icon-${currentTopicSlug}`);
        if (subtopicsDiv && icon) {
            subtopicsDiv.classList.remove('hidden');
            icon.style.transform = 'rotate(180deg)';
        }
    }
});
</script>
@endpush
