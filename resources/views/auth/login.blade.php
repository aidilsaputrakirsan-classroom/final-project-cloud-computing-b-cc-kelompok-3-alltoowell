@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gray-50">
    <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-md">
        <div class="text-center mb-6">
            <h1 class="text-3xl font-bold text-purple-600">Login SI-KOST</h1>
        </div>

        <form action="{{ route('login') }}" method="POST">
            @csrf

            <div class="mb-4">
                <input type="email" name="email" value="{{ old('email') }}"
                       placeholder="Email" required
                       class="w-full p-3 border rounded-lg @error('email') border-red-500 @enderror">

                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <input type="password" name="password" placeholder="Password" required
                       class="w-full p-3 border rounded-lg">
            </div>

            <button type="submit"
                class="w-full bg-purple-600 text-white py-3 rounded-lg font-semibold hover:bg-purple-700">
                Masuk
            </button>
        </form>

        <p class="text-center mt-4 text-sm">
            Belum punya akun?
            <a href="{{ route('register') }}" class="text-purple-600 font-semibold">
                Daftar
            </a>
        </p>
    </div>
</div>
@endsection
