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