@extends('layouts.auth')

@section('title', 'Register')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-100 via-blue-50 to-blue-100">

    <div class="w-full max-w-4xl bg-white shadow-2xl rounded-2xl overflow-hidden grid grid-cols-1 md:grid-cols-2">

        {{-- LEFT SIDE --}}
        <div class="bg-gradient-to-br from-blue-500 to-blue-700 text-white flex flex-col items-center justify-center p-10">
            <h2 class="text-3xl font-bold mb-4">Selamat Datang!</h2>
            <p class="mb-6 text-center opacity-90 text-sm">
                Isi data Anda dan bergabunglah bersama kami sekarang.
            </p>

            <a href="{{ route('login') }}"
                class="border-2 border-white px-8 py-2 rounded-xl hover:bg-white hover:text-blue-700 transition font-semibold text-sm shadow-lg">
                SIGN IN
            </a>
        </div>

        {{-- RIGHT SIDE – FORM --}}
        <div class="px-10 py-14 flex flex-col justify-center">
            <h2 class="text-4xl font-extrabold mb-8 text-blue-900 text-center tracking-wide">Daftar</h2>

            <form action="{{ route('register') }}" method="POST">
                @csrf

                <input type="text" name="name"
                    class="w-full p-3 rounded-xl bg-blue-50 border border-blue-200 mb-4 text-sm focus:ring-2 focus:ring-blue-400 outline-none"
                    placeholder="Nama Lengkap" value="{{ old('name') }}">

                @error('name')
                    <p class="text-red-500 text-xs mb-2">{{ $message }}</p>
                @enderror

                <input type="email" name="email"
                    class="w-full p-3 rounded-xl bg-blue-50 border border-blue-200 mb-4 text-sm focus:ring-2 focus:ring-blue-400 outline-none"
                    placeholder="Email" value="{{ old('email') }}">

                @error('email')
                    <p class="text-red-500 text-xs mb-2">{{ $message }}</p>
                @enderror

                <input type="text" name="phone"
                    class="w-full p-3 rounded-xl bg-blue-50 border border-blue-200 mb-4 text-sm focus:ring-2 focus:ring-blue-400 outline-none"
                    placeholder="No. HP" value="{{ old('phone') }}">

                @error('phone')
                    <p class="text-red-500 text-xs mb-2">{{ $message }}</p>
                @enderror

                <input type="password" name="password"
                    class="w-full p-3 rounded-xl bg-blue-50 border border-blue-200 mb-4 text-sm focus:ring-2 focus:ring-blue-400 outline-none"
                    placeholder="Password">

                @error('password')
                    <p class="text-red-500 text-xs mb-2">{{ $message }}</p>
                @enderror

                <input type="password" name="password_confirmation"
                    class="w-full p-3 rounded-xl bg-blue-50 border border-blue-200 mb-6 text-sm focus:ring-2 focus:ring-blue-400 outline-none"
                    placeholder="Konfirmasi Password">

                <button class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-xl font-semibold text-sm transition shadow-md">
                    SIGN UP
                </button>
            </form>
        </div>

    </div>
</div>
@endsection
