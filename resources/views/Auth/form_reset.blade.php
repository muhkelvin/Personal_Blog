<x-app-layout>
    <form method="POST" action="{{ route('password.update') }}" class="max-w-md mx-auto my-8 p-6 bg-white shadow-md rounded">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <div class="mb-4">
            <label for="email" class="block text-gray-700 font-bold mb-2">Email</label>
            <input type="email" name="email" id="email" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:border-blue-300" required>
            @if ($errors->has('email'))
                <span class="text-red-500 text-sm">{{ $errors->first('email') }}</span>
            @endif
        </div>
        <div class="mb-4">
            <label for="password" class="block text-gray-700 font-bold mb-2">Password</label>
            <input type="password" name="password" id="password" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:border-blue-300" required>
            @if ($errors->has('password'))
                <span class="text-red-500 text-sm">{{ $errors->first('password') }}</span>
            @endif
        </div>
        <div class="mb-4">
            <label for="password_confirmation" class="block text-gray-700 font-bold mb-2">Confirm Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:border-blue-300" required>
            @if ($errors->has('password_confirmation'))
                <span class="text-red-500 text-sm">{{ $errors->first('password_confirmation') }}</span>
            @endif
        </div>
        <button type="submit" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Reset Password</button>
    </form>



</x-app-layout>
