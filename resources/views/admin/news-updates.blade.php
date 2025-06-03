@extends('layouts.admin.app')
@section('title', 'News & Updates Management')

@section('content')



<div class="p-6 bg-gray-100 min-h-screen">
    <!-- Header Section -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">News & Updates Management</h1>
            <p class="text-gray-600 mt-2">Manage your organization's news, announcements, and updates</p>
        </div>
        <button onclick="openCreateModal()" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg shadow-lg transition duration-200 flex items-center space-x-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            <span>Create News</span>
        </button>
    </div>

    <!-- Statistics Cards -->
   <x-admin.news.StatisticsCards/>

    <!-- Filters and Search -->
    <x-admin.news.FiltersAndSearch :news="$news"/>

    <!-- News List -->
    <x-admin.news.NewsList :news="$news"/>
</div>

<!-- Create/Edit News Modal -->
<div id="newsModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-10 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-xl bg-white">
        <div class="flex justify-between items-center pb-4 border-b">
            <h3 id="modalTitle" class="text-xl font-semibold text-gray-900">Create News</h3>
            <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600 transition duration-150">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        
        <form id="newsForm" action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data" class="mt-6">
            @csrf
            <div id="methodField"></div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Title -->
                <div class="md:col-span-2">
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Title *</label>
                    <input type="text" id="title" name="title" required 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                           placeholder="Enter news title">
                </div>

                <!-- added_by -->
                 <input type="hidden" name="added_by" value="{{Session::get('admin_id')}}" />

                <!-- Category -->
                <div>
                    <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Category *</label>
                    <select id="category" name="category" required 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">Select Category</option>
                        <option value="event">Event</option>
                        <option value="announcement">Announcement</option>
                        <option value="research">Research</option>
                        <option value="startup">Startup</option>
                        <option value="seminar">Seminar</option>
                        <option value="funding">Funding</option>
                        <option value="training">Training</option>
                        <option value="achievement">Achievement</option>
                        <option value="notice">Notice</option>
                        <option value="workshop">Workshop</option>
                    </select>
                </div>
                
                <!-- Photo Upload -->
                <div>
                    <label for="news_photo" class="block text-sm font-medium text-gray-700 mb-2">Photo</label>
                    <input type="file" id="news_photo" name="news_photo" accept="image/*"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <div id="currentPhoto" class="mt-2 hidden">
                        <img id="currentPhotoImg" class="h-20 w-20 object-cover rounded-lg" src="" alt="Current photo">
                        <p class="text-xs text-gray-500 mt-1">Current photo</p>
                    </div>
                </div>
                
                <!-- Description -->
                <div class="md:col-span-2">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description *</label>
                    <textarea id="description" name="description" rows="6" required
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                              placeholder="Enter news description..."></textarea>
                </div>
            </div>
            
            <!-- Form Actions -->
            <div class="flex justify-end space-x-4 mt-8 pt-6 border-t">
                <button type="button" onclick="closeModal()" 
                        class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition duration-200">
                    Cancel
                </button>
                <button type="submit" 
                        class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition duration-200">
                    <span id="submitText">Create News</span>
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function openCreateModal() {
    document.getElementById('modalTitle').textContent = 'Create News';
    document.getElementById('submitText').textContent = 'Create News';
    document.getElementById('newsForm').action = '{{ route("admin.news.store") }}';
    document.getElementById('methodField').innerHTML = '';
    document.getElementById('newsForm').reset();
    document.getElementById('currentPhoto').classList.add('hidden');
    document.getElementById('newsModal').classList.remove('hidden');
}

function editNews(id) {
    // id.preventDefault();
    // Fetch news data and populate form
    fetch(`/admin/news/${id}/edit`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('modalTitle').textContent = 'Edit News';
            document.getElementById('submitText').textContent = 'Update News';
            document.getElementById('newsForm').action = `/admin/news/${id}`;
            document.getElementById('methodField').innerHTML = '@method("PUT")';
            
            document.getElementById('title').value = data.title;
            document.getElementById('category').value = data.category;
            document.getElementById('description').value = data.description;
            
            if (data.news_photo) {
                document.getElementById('currentPhoto').classList.remove('hidden');
                document.getElementById('currentPhotoImg').src = `/storage/${data.news_photo}`;
            }
            
            document.getElementById('newsModal').classList.remove('hidden');
        })
        .catch(error => console.error('Error:', error));
}

function viewNews(id) {
    // Implement view functionality or redirect to view page
    // id.preventDefault();
    window.location.href = `/news/show/${id}`;

    // window.location.href = `/news/show/${id}`;
}

function deleteNews(id) {
    // id.preventDefault();
    if (confirm('Are you sure you want to delete this news item?')) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/admin/news/${id}`;
        form.innerHTML = '@csrf @method("DELETE")';
        document.body.appendChild(form);
        form.submit();
    }
}

function closeModal() {
    document.getElementById('newsModal').classList.add('hidden');
}

// Close modal when clicking outside
document.getElementById('newsModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeModal();
    }
});
</script>
@endsection