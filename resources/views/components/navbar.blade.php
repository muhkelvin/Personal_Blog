<div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
    <div class="flex flex-shrink-0 items-center">
        <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=500" alt="Your Company">
    </div>
    <div class="hidden sm:ml-6 sm:block">
        <div class="flex space-x-4">
            @auth
                @if(Auth::user()->is_admin)
                    <a href="{{ route('admin.posts') }}" class="bg-gray-900 text-white rounded-md px-3 py-2 text-sm font-medium" aria-current="page">Post</a>
                    <a href="{{ route('admin.categories') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Category</a>
                    <a href="{{ route('admin.posts.create') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Add Post</a>
                    <a href="{{ route('admin.categories.create') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Add Category</a>
                @else
                    <a href="{{ route('user.posts') }}" class="bg-gray-900 text-white rounded-md px-3 py-2 text-sm font-medium" aria-current="page">My Posts</a>
                    <a href="{{ route('user.categories') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">My Categories</a>
                    <a href="{{ route('user.posts.create') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Add Post</a>
                @endif
            @else
                <a href="/" class="bg-gray-900 text-white rounded-md px-3 py-2 text-sm font-medium" aria-current="page">Home</a>
                @if(isset($categories[0]))
                    <a href="{{ route('category.show', $categories[0]->slug) }}" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">{{ $categories[0]->name }}</a>
                @else
                    <a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Judul Tidak Tersedia</a>
                @endif
                @if(isset($categories[1]))
                    <a href="{{ route('category.show', $categories[1]->slug) }}" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">{{ $categories[1]->name }}</a>
                @else
                    <a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Judul Tidak Tersedia</a>
                @endif
                <a href="{{ route('category') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Category List</a>
            @endauth

            <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
        </div>
    </div>
</div>

<div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
    @auth
        <span class="text-gray-700 text-sm font-medium mr-2">{{ auth()->user()->name }}</span>
        <form action="{{ route('logout') }}" method="post">
            @csrf
            <button type="submit" class="bg-gray-900 text-white rounded-md px-3 py-2 text-sm font-medium">Logout</button>
        </form>
    @else
        <a href="{{ route('login') }}" class="bg-gray-900 text-white rounded-md px-3 py-2 text-sm font-medium" aria-current="page">Login</a>
        <a href="{{route('register')}}" class="bg-gray-900 text-white rounded-md px-3 py-2 text-sm font-medium" aria-current="page">Register</a>
    @endauth
</div>

