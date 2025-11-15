<?php

namespace App\Http\Controllers;

use Supabase\SupabaseClient;

class BookingController extends Controller
{
    public function index()
    {
        $client = new SupabaseClient(
            env('SUPABASE_URL'),
            env('SUPABASE_KEY')
        );

        // Ambil data table booking
        $data = $client->from('booking')->select('*')->execute();

        return view('booking.index', [
            'bookings' => $data->getResult()
        ]);
    }
}
