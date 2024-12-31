<!-- Delete Confirmation Modal -->
<div id="confirmDeleteModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
    <div class="fixed inset-0 flex items-center justify-center p-4">
        <div class="bg-white rounded-lg w-full max-w-md mx-4 overflow-hidden">
            <div class="p-6 border-b">
                <div class="flex items-center">
                    <div class="bg-red-100 rounded-full p-3 mr-4">
                        <i class="fas fa-exclamation-triangle text-red-500 text-xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-[#375B5B] font-['Poppins']">Confirm Delete</h3>
                </div>
            </div>
            
            <div class="p-6">
                <p class="text-gray-600 font-['Roboto'] mb-4">
                    Warning: This action cannot be undone!
                </p>
                <p class="text-gray-600 font-['Roboto']">
                    Deleting this topic will also remove all its subtopics and associated content. Are you sure you want to proceed?
                </p>
            </div>

            <div class="px-6 py-4 bg-gray-50 flex justify-end space-x-3">
                <button type="button" 
                        onclick="closeDeleteModal()"
                        class="px-4 py-2 text-gray-600 hover:text-gray-800 font-['Oswald']">
                    Cancel
                </button>
                <form id="deleteTopicForm" method="POST" action="#">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition-all duration-300 font-['Oswald']">
                        Delete Topic
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
