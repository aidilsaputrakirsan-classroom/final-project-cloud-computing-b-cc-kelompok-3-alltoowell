@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="w-full max-w-4xl bg-white shadow-lg rounded-xl grid grid-cols-1 md:grid-cols-2 overflow-hidden">

        <!-- LEFT: FORM LOGIN -->
        <div class="px-10 py-14 flex flex-col justify-center">
            <h2 class="text-3xl font-bold mb-8 text-gray-800 text-center">Sign In</h2>

            <!-- FORM -->
            <form action="/login" method="POST">
                @csrf

                <input type="email" name="email"
                    class="w-full p-3 rounded-md bg-gray-100 mb-4 text-sm"
                    placeholder="Email">

                <input type="password" name="password"
                    class="w-full p-3 rounded-md bg-gray-100 mb-6 text-sm"
                    placeholder="Password">

                <button class="w-full bg-purple-500 hover:bg-purple-600 text-white py-2 rounded-full font-semibold">
                    SIGN IN
                </button>
            </form>
        </div>

        <!-- RIGHT: PANEL HIJAU -->
        <div class="bg-gradient-to-br from-purple-400 to-purple-600 text-white flex flex-col items-center justify-center p-10">
            <h2 class="text-3xl font-bold mb-4">Halo, Teman!</h2>
            <p class="mb-6 text-center opacity-90">
                Daftarkan diri anda dan mulai gunakan layanan kami segera
            </p>

            <a href="/register"
               class="border border-white px-6 py-2 rounded-full hover:bg-white hover:text-purple-600 transition font-semibold">
                SIGN UP
            </a>
        </div>

    </div>
</div>
@endsection
