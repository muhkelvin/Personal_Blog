<x-app-layout>
<div class="container mx-auto px-4 py-8">
    <div class="max-w-md mx-auto shadow rounded px-8 py-6 bg-white">
        <h1 class="text-2xl font-bold mb-4">Login</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login.authenticate') }}">
            @csrf

            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-bold mb-2">Email:</label>
                <input type="email" value="{{old('email')}}" name="email" id="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required autofocus>
            </div>

            <div class="mb-6">
                <label for="password" class="block text-gray-700 font-bold mb-2">Password:</label>
                <input type="password" name="password" id="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>

            <div class="flex items-center justify-between mb-6">
                <div class="form-check">
                    <input type="checkbox" name="remember" id="remember" class="rounded border-gray-300 text-gray-700 shadow-sm float-left focus:outline-none focus:ring-primary-500 focus:ring-w-2 h-5 w-5" />
                    <label for="remember" class="text-gray-700 ml-2">
                        Remember Me
                    </label>
                </div>

{{--                <a href="{{ route('password.request') }}" class="text-sm text-gray-600 hover:underline">--}}
{{--                    Forgot Your Password?--}}
{{--                </a>--}}
                <a href="/register" class="text-sm text-gray-600 hover:underline">
                    Belum Punya Akun? Register
                </a>
            </div>

            <div class="flex items-center justify-center">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Login
                </button>
            </div>
        </form>
    </div>
</div>
</x-app-layout>
