<?php

namespace App\Http\Controllers;

use App\Services\SupabaseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    protected $supabase;

    public function __construct(SupabaseService $supabase)
    {
        $this->supabase = $supabase;
    }

    /**
     * Tampilkan form booking untuk room tertentu
     */
    public function create($roomId)
    {
        $room = $this->supabase->getRoom($roomId);

        if (empty($room)) {
            abort(404, 'Kamar tidak ditemukan');
        }

        $room = $room[0]; // Supabase return array

        return view('booking.create', compact('room'));
    }

    /**
     * Simpan booking baru
     */
    public function store(Request $request, $roomId)
    {
        $room = $this->supabase->getRoom($roomId);
        if (empty($room)) abort(404);

        $room = $room[0];

        $request->validate([
            'name'        => 'required|string|max:255',
            'email'       => 'required|email',
            'phone'       => 'required|string|min:10',
            'nik'         => 'required|string|size:16',
            'start_date'  => 'required|date|after_or_equal:today',
            'duration'    => 'required|in:3,6,12',
            'payment'     => 'required|in:Transfer Bank,Cash,E-Wallet',
        ]);

        $totalPrice = $room['price'] * $request->duration;

        // Generate Booking ID: B001, B002, dst
        $latestId = $this->supabase->getLatestBookingId();
        $bookingId = 'B' . str_pad($latestId + 1, 3, '0', STR_PAD_LEFT);

        $bookingData = [
            'booking_id'       => $bookingId,
            'room_id'          => $roomId,
            'user_id'          => Auth::id(),
            'user_name'        => $request->name,
            'user_email'       => $request->email,
            'user_phone'       => $request->phone,
            'nik'              => $request->nik,
            'start_date'       => $request->start_date,
            'duration'         => (int)$request->duration,
            'payment_method'   => $request->payment,
            'total_price'      => $totalPrice,
            'status'           => 'pending',
            'created_at'       => now()->format('Y-m-d H:i:s'),
        ];

        $response = $this->supabase->createBooking($bookingData);

        if ($response->failed()) {
            return back()->withErrors(['error' => 'Gagal menyimpan booking']);
        }

        return redirect('/')->with('toast', "Pemesanan berhasil! ID: {$bookingId}. Tunggu konfirmasi admin.");
    }

    /**
     * Tampilkan daftar booking (Admin only)
     */
    public function index()
    {
        $bookings = $this->supabase->getAllBookingsWithRoom();

        return view('admin.bookings', compact('bookings'));
    }

    /**
     * Update status booking (Admin only)
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:confirmed,rejected,cancelled'
        ]);

        $response = $this->supabase->updateBookingStatus($id, $request->status);

        if ($response->failed()) {
            return back()->withErrors(['error' => 'Gagal update status']);
        }

        $statusLabel = [
            'confirmed' => 'Dikonfirmasi',
            'rejected'  => 'Ditolak',
            'cancelled' => 'Dibatalkan'
        ];

        return back()->with('toast', "Status booking diperbarui: {$statusLabel[$request->status]}");
    }

    /**
     * Hapus booking (Admin only) - BONUS
     */
    public function destroy($id)
    {
        $response = $this->supabase->deleteBooking($id);

        if ($response->failed()) {
            return back()->withErrors(['error' => 'Gagal hapus booking']);
        }

        return back()->with('toast', 'Booking berhasil dihapus');
    }
}
