<x-app-layout title="Categori List">
    <ul class="list-disc space-y-2">
        @forelse ($categories as $category)
            <li class="p-4 bg-gray-100 rounded hover:bg-gray-200 shadow">
                <a href="{{ route('category.show', $category->slug) }}" class="text-blue-500 hover:underline font-bold block mb-2">
                    {{ $category->name }}
                </a>
                <p class="text-gray-700">{{ Str::limit($category->body, 100) }}</p>
            </li>
        @empty
            <p class="text-gray-500">No articles found.</p>
        @endforelse
    </ul>

</x-app-layout>
