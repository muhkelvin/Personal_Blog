<x-app-layout>
    <form method="POST" action="{{ route('otp.postVerify') }}" class="max-w-md mx-auto my-8 p-6 bg-white shadow-md rounded">
        @csrf
        <div class="mb-4">
            <label for="otp" class="block text-gray-700 font-bold mb-2">OTP</label>
            <input type="text" name="otp" id="otp" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:border-blue-300" required>
            @if ($errors->has('otp'))
                <span class="text-red-500 text-sm">{{ $errors->first('otp') }}</span>
            @endif
        </div>
        <button type="submit" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Verify OTP</button>
    </form>


</x-app-layout>
