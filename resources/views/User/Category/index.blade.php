<x-app-layout>
    @if (session('success'))
        <div class="bg-green-200 text-green-800 px-4 py-2 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif
    <ul class="list-disc space-y-2">
        @forelse ($categories as $category)
            <li class="p-4 bg-gray-100 rounded hover:bg-gray-200 shadow flex justify-between items-center">
                <div>
                    <a href="{{ route('user.categories.show', $category->slug) }}" class="text-blue-500 hover:underline font-bold block mb-2">
                        {{ $category->name }}
                    </a>
                </div>
                <div>
                    <a href="{{ route('user.categories.show', $category->slug) }}" class="text-green-500 hover:text-green-700 font-bold mr-2">Show</a>
                    <a href="{{ route('user.categories.edit', $category->slug) }}" class="text-yellow-500 hover:text-yellow-700 font-bold mr-2">Update</a>
                    <form action="{{ route('user.categories.destroy', $category->slug) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-700 font-bold">Delete</button>
                    </form>
                </div>
            </li>
        @empty
            <li class="p-4 bg-gray-100 rounded">
                <p class="text-gray-500">No Genre found.</p>
            </li>
        @endforelse
    </ul>

{{--    {{$categorys->links()}}--}}
</x-app-layout>
