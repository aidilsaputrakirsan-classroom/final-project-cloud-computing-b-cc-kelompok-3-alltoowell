<?php

namespace App\Http\Controllers;

use App\Services\SupabaseService;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    protected $supabase;

    public function __construct(SupabaseService $supabase)
    {
        $this->supabase = $supabase;
    }

    // TAMPILKAN FORM BOOKING DENGAN URL /booking/room1, room2, dll
    public function show($roomCode)
    {
        // Ambil angka dari "room1" → 1
        $number = ltrim($roomCode, 'room');

        // DAFTAR SEMUA KAMAR (TAMBAH SEPUASNYA DI SINI!)
        $rooms = [
            1 => [
                'id' => 'e2bfc970-b3f0-4a4f-bde5-0ab60f628e10',
                'name' => 'Kamar Deluxe',
                'price' => 1500000,
                'location' => 'Lantai 2'
            ],
            2 => [
                'id' => '8f1a2b3c-4d5e-6f7g-8h9i-0j1k2l3m4n5o',
                'name' => 'Kamar Standard',
                'price' => 900000,
                'location' => 'Lantai 1'
            ],
            3 => [
                'id' => '1a2b3c4d-5e6f-7g8h-9i0j-1k2l3m4n5o6p',
                'name' => 'Kamar VIP',
                'price' => 2000000,
                'location' => 'Lantai 3'
            ],
            4 => [
                'id' => 'uuid-kamar-4',
                'name' => 'Kamar Family',
                'price' => 2500000,
                'location' => 'Lantai 4'
            ],
            // TAMBAH KAMAR BARU DI SINI AJA!
            // 99 => ['id' => 'uuid-nya', 'name' => 'Kamar Premium', 'price' => 3000000, 'location' => 'Lantai 99'],
        ];

        if (!isset($rooms[$number])) {
            abort(404, "Kamar {$roomCode} tidak ditemukan!");
        }

        return view('booking.create', ['room' => $rooms[$number]]);
    }

    // SIMPAN BOOKING DARI /booking/room1, room2, dll
    public function store(Request $request, $roomCode)
    {
        $number = ltrim($roomCode, 'room');
        $rooms = [
            1 => ['id' => 'e2bfc970-b3f0-4a4f-bde5-0ab60f628e10', 'price' => 1500000],
            2 => ['id' => '8f1a2b3c-4d5e-6f7g-8h9i-0j1k2l3m4n5o', 'price' => 900000],
            3 => ['id' => '1a2b3c4d-5e6f-7g8h-9i0j-1k2l3m4n5o6p', 'price' => 2000000],
            // tambah di sini...
        ];

        if (!isset($rooms[$number])) {
            abort(404);
        }

        $room = $rooms[$number];
        $roomId = $room['id'];

        $request->validate([
            'name'       => 'required|string|max:255',
            'email'      => 'required|email',
            'phone'      => 'required|string|min:10',
            'nik'        => 'required|string|size:16',
            'start_date' => 'required|date|after_or_equal:today',
            'duration'   => 'required|in:3,6,12',
            'payment'    => 'required|in:Transfer Bank,Cash,E-Wallet',
        ]);

        $totalPrice = $room['price'] * $request->duration;
        $nextNumber = $this->supabase->getBookingCount() + 1;
        $bookingId  = 'B' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

        $bookingData = [
            'booking_id'     => $bookingId,
            'room_id'        => $roomId,
            'user_id'        => 999,
            'user_name'      => $request->name,
            'user_email'     => $request->email,
            'user_phone'     => $request->phone,
            'nik'            => $request->nik,
            'start_date'     => $request->start_date,
            'duration'       => (int)$request->duration,
            'payment_method' => $request->payment,
            'total_price'    => $totalPrice,
            'status'         => 'pending',
            'created_at'     => now()->toDateTimeString(),
        ];

        $response = $this->supabase->createBooking($bookingData);

        if ($response->failed()) {
            return back()->with('error', 'Gagal simpan: ' . $response->body());
        }

        return redirect('/admin')->with('toast', "Booking {$bookingId} berhasil!");
    }

    // ADMIN PANEL
    public function index()
    {
        $response = $this->supabase->getAllBookingsWithRoom();
        $bookings = is_string($response) ? json_decode($response, true) : $response;
        $bookings = $bookings ?? [];

        return view('admin.bookings', compact('bookings'));
    }

    // UPDATE STATUS
    public function update(Request $request, $id)
    {
        $request->validate(['status' => 'required|in:confirmed,rejected,cancelled']);
        $response = $this->supabase->updateBookingStatus($id, $request->status);

        if ($response->failed()) {
            return back()->with('error', 'Gagal update status');
        }

        return back()->with('toast', 'Status berhasil diubah!');
    }

    // HAPUS
    public function destroy($id)
    {
        $response = $this->supabase->deleteBooking($id);
        if ($response->failed()) {
            return back()->with('error', 'Gagal hapus');
        }
        return back()->with('toast', 'Booking dihapus!');
    }
}
