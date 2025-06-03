@extends('layouts.admin.app')
@section('title', 'News & Updates Management')

@section('content')
@php
use Illuminate\Support\Collection;

$news = collect([
    (object)[
        'news_id' => 1,
        'title' => 'New Startup Launched',
        'category' => 'startup',
        'description' => 'A new startup has launched in the tech industry.',
        'news_photo' => 'https://via.placeholder.com/150',
        'created_at' => now(),
        'admin' => (object)['name' => 'Admin User']
    ],
    (object)[
        'news_id' => 2,
        'title' => 'New Seminar Scheduled',
        'category' => 'seminar',
        'description' => 'A new seminar is scheduled for next month.',
        'news_photo' => 'https://via.placeholder.com/150',
        'created_at' => now(),
        'admin' => (object)['name' => 'Admin User']
    ],
    (object)[
        'news_id' => 3,
        'title' => 'New Research Published',
        'category' => 'research',
        'description' => 'A new research paper has been published.',
        'news_photo' => 'https://via.placeholder.com/150',
        'created_at' => now(),
        'admin' => (object)['name' => 'Admin User']
    ]
]);
@endphp

<div class="p-6 bg-gray-50 min-h-screen">
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
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total News</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $totalNews ?? 0 }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">This Month</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $monthlyNews ?? 0 }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5-5-5h5v-5a7.5 7.5 0 11-15 0c0-2.5 1-5 3-7"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Events</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $eventNews ?? 0 }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.99 1.99 0 013 12V7a4 4 0 014-4z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Announcements</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $announcementNews ?? 0 }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters and Search -->
    <div class="bg-white rounded-xl shadow-sm p-6 mb-8 border border-gray-100">
        <form method="GET" action="{{ route('admin.news.store') }}" class="flex flex-wrap gap-4 items-end">
            <div class="flex-1 min-w-64">
                <label class="block text-sm font-medium text-gray-700 mb-2">Search</label>
                <input type="text" name="search" value="{{ request('search') }}" 
                       placeholder="Search by title or description..." 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
            <div class="min-w-48">
                <label class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                <select name="category" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">All Categories</option>
                    <option value="event" {{ request('category') == 'event' ? 'selected' : '' }}>Event</option>
                    <option value="announcement" {{ request('category') == 'announcement' ? 'selected' : '' }}>Announcement</option>
                    <option value="research" {{ request('category') == 'research' ? 'selected' : '' }}>Research</option>
                    <option value="startup" {{ request('category') == 'startup' ? 'selected' : '' }}>Startup</option>
                    <option value="seminar" {{ request('category') == 'seminar' ? 'selected' : '' }}>Seminar</option>
                    <option value="funding" {{ request('category') == 'funding' ? 'selected' : '' }}>Funding</option>
                    <option value="training" {{ request('category') == 'training' ? 'selected' : '' }}>Training</option>
                    <option value="achievement" {{ request('category') == 'achievement' ? 'selected' : '' }}>Achievement</option>
                    <option value="notice" {{ request('category') == 'notice' ? 'selected' : '' }}>Notice</option>
                    <option value="workshop" {{ request('category') == 'workshop' ? 'selected' : '' }}>Workshop</option>
                </select>
            </div>
            <div class="flex space-x-2">
                <button type="submit" class="bg-gray-800 hover:bg-gray-900 text-white px-6 py-2 rounded-lg transition duration-200">
                    Filter
                </button>
                <a href="{{ route('admin.news.store') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-6 py-2 rounded-lg transition duration-200">
                    Clear
                </a>
            </div>
        </form>
    </div>

    <!-- News List -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100">
        <div class="p-6 border-b border-gray-100">
            <h2 class="text-xl font-semibold text-gray-900">News List</h2>
        </div>
        
        @if($news->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">News</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Added By</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($news as $item)
                        <tr class="hover:bg-gray-50 transition duration-150">
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    @if($item->news_photo)
                                        <img class="h-12 w-12 rounded-lg object-cover mr-4" src="{{ asset('storage/' . $item->news_photo) }}" alt="">
                                    @else
                                        <div class="h-12 w-12 rounded-lg bg-gray-200 flex items-center justify-center mr-4">
                                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                    @endif
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">{{ $item->title }}</div>
                                        <div class="text-sm text-gray-500">{{ Str::limit($item->description, 50) }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full 
                                    @if($item->category == 'event') bg-blue-100 text-blue-800
                                    @elseif($item->category == 'announcement') bg-green-100 text-green-800
                                    @elseif($item->category == 'research') bg-purple-100 text-purple-800
                                    @elseif($item->category == 'startup') bg-yellow-100 text-yellow-800
                                    @elseif($item->category == 'seminar') bg-indigo-100 text-indigo-800
                                    @elseif($item->category == 'funding') bg-pink-100 text-pink-800
                                    @elseif($item->category == 'training') bg-teal-100 text-teal-800
                                    @elseif($item->category == 'achievement') bg-orange-100 text-orange-800
                                    @else bg-gray-100 text-gray-800 @endif">
                                    {{ ucfirst($item->category) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                {{ $item->admin->name ?? 'N/A' }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                {{ $item->created_at->format('M d, Y') }}
                            </td>
                            <td class="px-6 py-4 text-sm font-medium">
                                <div class="flex items-center space-x-2">
                                    <button onclick="viewNews({{ $item->news_id }})" class="text-blue-600 hover:text-blue-900 transition duration-150">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </button>
                                    <button onclick="editNews({{ $item->news_id }})" class="text-green-600 hover:text-green-900 transition duration-150">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </button>
                                    <button onclick="deleteNews({{ $item->news_id }})" class="text-red-600 hover:text-red-900 transition duration-150">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="px-6 py-4 border-t border-gray-100">
                
            </div>
        @else
            <div class="p-12 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                </svg>
                <h3 class="mt-4 text-lg font-medium text-gray-900">No news found</h3>
                <p class="mt-2 text-gray-500">Get started by creating your first news item.</p>
                <button onclick="openCreateModal()" class="mt-4 bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition duration-200">
                    Create News
                </button>
            </div>
        @endif
    </div>
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
    window.location.href = `/admin/news/${id}`;
}

function deleteNews(id) {
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