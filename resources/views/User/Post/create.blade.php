<x-app-layout>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Add Posts</h1>

        @if ($errors->any())
            <div class="mb-4">
                <ul class="text-danger list-disc pl-4">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('user.posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label for="title" class="block font-medium text-gray-700 mb-2">Title:</label>
                <input type="text" name="title" id="title" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter movie title" required>
            </div>

            <div class="mb-4">
                <label for="excerpt" class="block font-medium text-gray-700 mb-2">Excerpt:</label>
                <textarea name="excerpt" id="excerpt" rows="3" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter a short summary" required></textarea>
            </div>

            <div class="mb-4">
                <label for="body" class="block font-medium text-gray-700 mb-2">Body:</label>
                <textarea name="body" id="body" rows="10" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter the full movie body"></textarea>
            </div>

            <div class="mb-4">
                <label for="image" class="block font-medium text-gray-700 mb-2">Image:</label>
                <input type="file" name="image" id="image" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="mb-4">
                <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select a Category</label>
                <select id="countries" name="category_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected disabled>Choose a Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold mt-4 py-2 px-4 rounded">Add Post</button>
        </form>

    </div>

    <script src="https://cdn.ckeditor.com/ckeditor5/37.0.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#body'), {
                toolbar: {
                    items: [
                        'heading',
                        '|',
                        'bold',
                        'italic',
                        'link',
                        'bulletedList',
                        'numberedList',
                        '|',
                        'undo',
                        'redo'
                    ],
                    shouldNotGroupWhenFull: true
                },
                language: 'en'
            })
            .then(editor => {
                editor.ui.view.toolbar.element.querySelector('button[aria-label="Insert image"]').style.display = 'none';
            })
            .catch(error => {
                console.error(error);
            });
    </script>
</x-app-layout>
