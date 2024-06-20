<x-app-layout>
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
