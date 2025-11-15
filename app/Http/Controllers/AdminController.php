<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use App\Models\Booking;
use App\Models\Pengguna;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalKamar = Kamar::count();
        $kamarAvailable = Kamar::where('status', 1)->count(); // 1 = Available
        $kamarUnavailable = Kamar::where('status', 0)->count(); // 0 = Unavailable
        $totalBooking = Booking::count();

        return view('admin.dashboard', compact(
            'totalKamar',
            'kamarAvailable',
            'kamarUnavailable',
            'totalBooking'
        ));
    }
}
