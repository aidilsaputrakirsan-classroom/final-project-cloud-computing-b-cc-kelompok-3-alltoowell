@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="w-full max-w-4xl bg-white shadow-lg rounded-xl grid grid-cols-1 md:grid-cols-2 overflow-hidden">

        <!-- LEFT: PANEL HIJAU -->
        <div class="bg-gradient-to-br from-purple-400 to-purple-600 text-white flex flex-col items-center justify-center p-10">
            <h2 class="text-3xl font-bold mb-4">Selamat Datang!</h2>
            <p class="mb-6 text-center opacity-90">
                Masukkan data anda dan bergabunglah bersama kami sekarang.
            </p>

            <a href="/login"
               class="border border-white px-6 py-2 rounded-full hover:bg-white hover:text-purple-600 transition font-semibold">
                SIGN IN
            </a>
        </div>

        <!-- RIGHT: FORM REGISTER -->
        <div class="px-10 py-14 flex flex-col justify-center">
            <h2 class="text-3xl font-bold mb-8 text-gray-800 text-center">Sign Up</h2>

            <form action="/register" method="POST">
                @csrf

                <input type="text" name="name"
                    class="w-full p-3 rounded-md bg-gray-100 mb-4 text-sm"
                    placeholder="Nama Lengkap">

                <input type="email" name="email"
                    class="w-full p-3 rounded-md bg-gray-100 mb-4 text-sm"
                    placeholder="Email">

                <input type="text" name="phone"
                    class="w-full p-3 rounded-md bg-gray-100 mb-4 text-sm"
                    placeholder="No. HP">

                <input type="password" name="password"
                    class="w-full p-3 rounded-md bg-gray-100 mb-4 text-sm"
                    placeholder="Password">

                <input type="password" name="password_confirmation"
                    class="w-full p-3 rounded-md bg-gray-100 mb-6 text-sm"
                    placeholder="Konfirmasi Password">

                <button class="w-full bg-purple-500 hover:bg-purple-600 text-white py-2 rounded-full font-semibold">
                    SIGN UP
                </button>
            </form>
        </div>

    </div>
</div>
@endsection
