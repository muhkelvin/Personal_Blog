<x-app-layout>
    <form method="GET" action="{{ route('home') }}" class="mb-4">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search..." class="border p-2 rounded">

        <select name="category" class="border p-2 rounded">
            <option value="">All Categories</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>

        <select name="sort" class="border p-2 rounded">
            <option value="">Sort By</option>
            <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest</option>
            <option value="alphabetical" {{ request('sort') == 'alphabetical' ? 'selected' : '' }}>A-Z</option>
        </select>

        <button type="submit" class="bg-blue-500 text-white p-2 rounded">Search</button>
    </form>

    <ul class="list-disc space-y-2">
        @forelse ($posts as $post)
            <li class="p-4 bg-gray-100 rounded hover:bg-gray-200 shadow">
                <a href="{{ route('post', $post->slug) }}" class="text-blue-500 hover:underline font-bold block mb-2">
                    {{ $post->title }}
                </a>
                <p class="text-gray-700">{{ Str::limit($post->body, 100) }}</p>
            </li>
        @empty
            <p class="text-gray-500">No articles found.</p>
        @endforelse
    </ul>
    {{$posts->links()}}
</x-app-layout>
