<x-app-layout>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Add Genre</h1>

        @if ($errors->any())
            <div class="mb-4">
                <ul class="text-danger list-disc pl-4">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label for="title" class="block font-medium text-gray-700 mb-2">Title:</label>
                <input type="text" name="name" id="title" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter Category title" required>
            </div>

            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add Movie</button>
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
</x-app-layout>
