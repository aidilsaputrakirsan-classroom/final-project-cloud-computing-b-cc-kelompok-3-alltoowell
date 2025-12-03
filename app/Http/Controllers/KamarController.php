<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class KamarController extends Controller
{
    public function index()
    {
        $url = env('SUPABASE_URL') . '/rest/v1/' . env('SUPABASE_TABLE');

        $response = Http::withHeaders([
            'apikey' => env('SUPABASE_KEY'),
            'Authorization' => "Bearer " . env('SUPABASE_KEY'),
        ])->get($url . '?select=*');

        $data = $response->json();

        return view('admin.dashboard', [
            'kamar' => $data ?? []
        ]);
    }
}
