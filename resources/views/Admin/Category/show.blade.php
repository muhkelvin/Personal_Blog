<!-- show.blade.php -->

<x-app-layout>
    <div class="container mx-auto p-4">
        <ul class="list-disc space-y-2">
            @forelse ($categories->posts as $post)
                <li class="p-4 bg-gray-100 rounded hover:bg-gray-200 shadow flex justify-between items-center">
                    <div>
                        <a href="" class="text-blue-500 hover:underline font-bold block mb-2">
                            {{ $post->title }}
                        </a>
                    </div>
{{--                    <div>--}}
{{--                        <a href="{{ route('admin.categories.show', $category->slug) }}" class="text-green-500 hover:text-green-700 font-bold mr-2">Show</a>--}}
{{--                    </div>--}}
                </li>
            @empty
                <li class="p-4 bg-gray-100 rounded">
                    <p class="text-gray-500">No Genre found.</p>
                </li>
            @endforelse
        </ul>
    </div>
</x-app-layout>
