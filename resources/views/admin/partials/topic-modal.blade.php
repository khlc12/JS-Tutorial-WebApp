<!-- Add/Edit Topic Modal -->
<div id="topicModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
    <div class="fixed inset-0 flex items-center justify-center p-4">
        <div class="bg-white rounded-lg w-full max-w-2xl mx-4">
            <!-- Modal Header -->
            <div class="p-6 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <h3 class="text-xl font-bold text-[#375B5B] font-['Poppins']">Add New Topic</h3>
                    <button onclick="closeAddTopicModal()" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
            </div>

            <!-- Modal Content -->
            <div class="p-6 max-h-[calc(90vh-200px)] overflow-y-auto">
                <form id="topicForm" method="POST" action="{{ route('topics.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="space-y-6">
                        <!-- Topic Title -->
                        <div>
                            <label for="title" class="block text-sm text-gray-600 mb-1">Topic Title</label>
                            <input type="text" 
                                   id="title" 
                                   name="title" 
                                   required
                                   class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:outline-none focus:ring-2 focus:ring-[#3C8C4E] font-['Roboto']"
                                   placeholder="Enter topic title">
                        </div>

                        <!-- Subtopics Container -->
                        <div id="subtopicsContainer" class="space-y-6">
                            <div class="subtopic-entry bg-gray-50 p-4 rounded-lg">
                                <div class="flex gap-4 mb-3">
                                    <div class="flex-1">
                                        <label class="block text-sm text-gray-600 mb-1">Subtopic Title</label>
                                        <input type="text" 
                                               name="subtopics[0][title]" 
                                               required
                                               class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:outline-none focus:ring-2 focus:ring-[#3C8C4E] font-['Roboto']"
                                               placeholder="Enter subtopic title">
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm text-gray-600 mb-1">Content File</label>
                                    <p class="text-xs text-gray-500 mb-2">Upload a text file containing the content (Supported formats: .txt, .md)</p>
                                    <div class="relative">
                                        <input type="file" 
                                               name="subtopics[0][content_file]"
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
                            </div>
                        </div>

                        <!-- Add Another Subtopic Button -->
                        <button type="button" 
                                onclick="addSubtopic()"
                                class="w-full py-2 border-2 border-dashed border-gray-300 rounded-lg text-gray-600 hover:border-[#3C8C4E] hover:text-[#3C8C4E] transition-colors duration-300 font-['Oswald']">
                            <i class="fas fa-plus mr-2"></i> Add Another Subtopic
                        </button>
                    </div>
                </form>
            </div>

            <!-- Modal Footer -->
            <div class="px-6 py-4 bg-gray-50 flex justify-end space-x-3">
                <button onclick="closeAddTopicModal()" 
                        class="px-6 py-2 text-gray-600 hover:text-gray-800 font-['Oswald']">
                    Cancel
                </button>
                <button onclick="submitTopicForm()" 
                        class="bg-[#3C8C4E] text-white px-6 py-2 rounded-lg hover:bg-[#2D6B3B] transition-all duration-300 font-['Oswald']">
                    Save Topic
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    function submitTopicForm() {
        const form = document.getElementById('topicForm');
        const formData = new FormData(form);
        
        // Validate all required fields
        const inputs = form.querySelectorAll('input[required]');
        let isValid = true;
        
        inputs.forEach(input => {
            if (!input.value) {
                isValid = false;
                input.classList.add('border-red-500');
            } else {
                input.classList.remove('border-red-500');
            }
        });
        
        if (!isValid) {
            alert('Please fill in all required fields');
            return;
        }
        
        // Submit the form
        form.submit();
    }
</script>