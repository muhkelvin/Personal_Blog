<x-layout>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Edit Movie</h1>

        @if ($errors->any())
            <div class="mb-4">
                <ul class="text-danger list-disc pl-4">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.movies.update', $movie->slug) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') {{-- Atau gunakan @method('PATCH') tergantung pada preferensi Anda --}}

            <div class="mb-4">
                <label for="title" class="block font-medium text-gray-700 mb-2">Title:</label>
                <input type="text" name="title" id="title" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter movie title" value="{{ old('title', $movie->title) }}" required>
            </div>

            <div class="mb-4">
                <label for="excerpt" class="block font-medium text-gray-700 mb-2">Excerpt:</label>
                <textarea name="excerpt" id="excerpt" rows="3" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter a short summary" required>{{ old('excerpt', $movie->excerpt) }}</textarea>
            </div>

            <div class="mb-4">
                <label for="synopsis" class="block font-medium text-gray-700 mb-2">Synopsis:</label>
                <textarea name="synopsis" id="synopsis" rows="10" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter the full movie synopsis" required>{{ old('synopsis', $movie->synopsis) }}</textarea>
            </div>

            <div class="mb-4">
                <label for="image" class="block font-medium text-gray-700 mb-2">Image:</label>
                <input type="file" name="image" id="image" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="mb-4">
                <label for="movie_url" class="block font-medium text-gray-700 mb-2">Movie URL:</label>
                <input type="url" name="movie_url" id="movie_url" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter movie URL (optional)" value="{{ old('movie_url', $movie->movie_url) }}">
            </div>

            <div class="mb-4">
                <label for="tags" class="block font-medium text-gray-700 mb-2">Genres:</label>
                <select id="input-tags" name="genres[]" multiple>
                    @foreach($genres as $genre)
                        <option value="{{ $genre->id }}" {{ $movie->genres && in_array($genre->id, $movie->genres->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $genre->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update Movie</button>
        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/tom-select/1.8.2/js/tom-select.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tom-select/1.8.2/css/tom-select.min.css" rel="stylesheet">
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            new TomSelect("#input-tags", {
                persist: false,
                createOnBlur: true,
                create: true
            });
        });
    </script>
</x-layout>
