<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // DATA DUMMY (SAMA SEPERTI DI JS ANDA)
        $allRooms = [
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
            [
                'id' => '7',
                'name' => 'Kamar VIP E1',
                'price' => 2500000,
                'location' => 'Jl. Ahmad Yani No. 30',
                'capacity' => 1,
                'image' => 'https://images.unsplash.com/photo-1668089677938-b52086753f77?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=1080',
                'status' => 'available',
                'facilities' => ['AC', 'Kasur King Size', 'Lemari', 'Meja Belajar', 'WiFi', 'Kamar Mandi Dalam', 'TV Smart', 'Kulkas', 'Kitchen Set']
            ],
            [
                'id' => '8',
                'name' => 'Kamar Budget F1',
                'price' => 800000,
                'location' => 'Jl. Pahlawan No. 45',
                'capacity' => 1,
                'image' => 'https://images.unsplash.com/photo-1579632151052-92f741fb9b79?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=1080',
                'status' => 'available',
                'facilities' => ['Kipas Angin', 'Kasur', 'Lemari', 'WiFi', 'Kamar Mandi Luar']
            ],
            [
                'id' => '9',
                'name' => 'Kamar Premium C4',
                'price' => 1800000,
                'location' => 'Jl. Rapak Lambur No. 24',
                'capacity' => 1,
                'image' => 'https://images.unsplash.com/photo-1664813953289-7c3350f040e0?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=1080',
                'status' => 'available',
                'facilities' => ['AC', 'Kasur', 'Lemari', 'Meja Belajar', 'WiFi', 'Kamar Mandi Dalam', 'TV']
            ],
        ];

        // Hitung statistik
        $totalRooms = count($allRooms);
        $availableRooms = count(array_filter($allRooms, fn($r) => $r['status'] === 'available'));

        // PAGINATION MANUAL UNTUK ARRAY
        $perPage = 6; // Jumlah item per halaman
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentItems = array_slice($allRooms, ($currentPage - 1) * $perPage, $perPage);

        $rooms = new LengthAwarePaginator(
            $currentItems,
            count($allRooms),
            $perPage,
            $currentPage,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return view('home.index', compact('rooms', 'totalRooms', 'availableRooms'));
    }
}