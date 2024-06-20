<x-app-layout>
    <ul class="list-disc space-y-2">
        <div class="container mx-auto px-4 py-8">
            <h1 class="text-3xl font-bold mb-4">{{ $post->title }}</h1>
            @if ($post->image)
            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }} image" class="w-55 mb-4 rounded shadow">
            @endif

            <div class="text-gray-700 prose prose-sm">{!! $post->body !!}</div>

            <p class="text-gray-500 text-sm mt-4">
                By: {{ $post->user->name }} ({{ $post->created_at->format('d F Y') }})
                <a href="{{ route('category.show', $post->category->slug) }}">Category: {{ $post->category->name }}</a>
            </p>
        </div>
    </ul>
</x-app-layout>
