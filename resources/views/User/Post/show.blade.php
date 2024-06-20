<!-- show.blade.php -->

<x-layout>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">{{ $movie->title }}</h1>

        <img src="{{ asset('storage/' . $movie->image) }}" alt="Movie Image">

        <div class="mb-4">
            <iframe width="560" height="315" src="{{ $movie->movie_url }}" frameborder="0" allowfullscreen></iframe>
        </div>

        <div class="mb-4">
            <h2 class="text-xl font-bold mb-2">Synopsis:</h2>
            <p>{{ $movie->synopsis }}</p>
        </div>
    </div>
</x-layout>
