@extends('layouts.app')
@section('title', 'Daftar')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gray-50">
    <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-md">
        <div class="text-center mb-6">
            <h1 class="text-3xl font-bold text-purple-600">Daftar SI-KOST</h1>
        </div>

        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="mb-4">
                <input type="text" name="name" value="{{ old('name') }}" placeholder="Nama Lengkap" required
                       class="w-full p-3 border rounded-lg @error('name') border-red-500 @enderror">
                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <input type="email" name="email" value="{{ old('email') }}" placeholder="Email" required
                       class="w-full p-3 border rounded-lg @error('email') border-red-500 @enderror">
                @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <input type="text" name="phone" value="{{ old('phone') }}" placeholder="No. HP" required
                       class="w-full p-3 border rounded-lg @error('phone') border-red-500 @enderror">
                @error('phone') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <input type="password" name="password" placeholder="Password" required
                       class="w-full p-3 border rounded-lg @error('password') border-red-500 @enderror">
                @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-6">
                <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required
                       class="w-full p-3 border rounded-lg">
            </div>

            <button type="submit" class="w-full bg-purple-600 text-white py-3 rounded-lg font-semibold hover:bg-purple-700">
                Daftar
            </button>
        </form>

        <p class="text-center mt-4 text-sm">
            Sudah punya akun? <a href="{{ route('login') }}" class="text-purple-600 font-semibold">Login</a>
        </p>
    </div>
</div>
@endsection
