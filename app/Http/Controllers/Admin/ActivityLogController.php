<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class ActivityLogController extends Controller
{
    public function index()
    {
        $supabaseUrl = rtrim(env('SUPABASE_URL'), '/')
            . '/rest/v1/activity_logs?action=eq.create_booking&select=*';

        $supabaseKey = env('SUPABASE_KEY');

        $logs = Http::withHeaders([
            'apikey'        => $supabaseKey,
            'Authorization' => 'Bearer ' . $supabaseKey
        ])->get($supabaseUrl)->json();

        return view('admin.activity.index', compact('logs'));
    }
}
