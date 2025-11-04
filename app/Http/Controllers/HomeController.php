<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // DATA DUMMY (SAMA SEPERTI DI JS ANDA)
        $rooms = [
            [
                'id' => '1',
                'name' => 'Kamar Deluxe A1',
                'price' => 1500000,
                'location' => 'Jl. Soekarno Hatta No. 15',
                'capacity' => 1,
                'image' => 'https://images.unsplash.com/photo-1668089677938-b52086753f77?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=1080',
                'status' => 'available',
                'facilities' => ['AC', 'Kasur', 'Lemari', 'Meja Belajar', 'WiFi', 'Kamar Mandi Dalam']
            ],
            [
                'id' => '2',
                'name' => 'Kamar Standard B2',
                'price' => 1000000,
                'location' => 'Jl. Gunung Lingai No. 8',
                'capacity' => 1,
                'image' => 'https://images.unsplash.com/photo-1579632151052-92f741fb9b79?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=1080',
                'status' => 'available',
                'facilities' => ['Kipas Angin', 'Kasur', 'Lemari', 'WiFi', 'Kamar Mandi Luar']
            ],
            [
                'id' => '3',
                'name' => 'Kamar Premium C3',
                'price' => 2000000,
                'location' => 'Jl. Rapak Lambur No. 22',
                'capacity' => 1,
                'image' => 'https://images.unsplash.com/photo-1664813953289-7c3350f040e0?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=1080',
                'status' => 'available',
                'facilities' => ['AC', 'Kasur', 'Lemari', 'Meja Belajar', 'WiFi', 'Kamar Mandi Dalam', 'TV', 'Kulkas']
            ],
            [
                'id' => '4',
                'name' => 'Kamar Sharing D4',
                'price' => 750000,
                'location' => 'Jl. Pramuka No. 5',
                'capacity' => 2,
                'image' => 'https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=1080',
                'status' => 'available',
                'facilities' => ['Kipas Angin', 'Kasur 2x', 'Lemari 2x', 'WiFi', 'Kamar Mandi Luar']
            ],
            [
                'id' => '5',
                'name' => 'Kamar Deluxe A2',
                'price' => 1600000,
                'location' => 'Jl. Soekarno Hatta No. 15',
                'capacity' => 1,
                'image' => 'https://images.unsplash.com/photo-1668089677938-b52086753f77?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=1080',
                'status' => 'available',
                'facilities' => ['AC', 'Kasur', 'Lemari', 'Meja Belajar', 'WiFi', 'Kamar Mandi Dalam', 'Balkon']
            ],
            [
                'id' => '6',
                'name' => 'Kamar Standard B3',
                'price' => 950000,
                'location' => 'Jl. Mulawarman No. 12',
                'capacity' => 1,
                'image' => 'https://images.unsplash.com/photo-1579632151052-92f741fb9b79?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=1080',
                'status' => 'occupied',
                'facilities' => ['Kipas Angin', 'Kasur', 'Lemari', 'WiFi', 'Kamar Mandi Luar']
            ],
        ];

        $totalRooms = count($rooms);
        $availableRooms = count(array_filter($rooms, fn($r) => $r['status'] === 'available'));

        return view('home.index', compact('rooms', 'totalRooms', 'availableRooms'));
    }
}
