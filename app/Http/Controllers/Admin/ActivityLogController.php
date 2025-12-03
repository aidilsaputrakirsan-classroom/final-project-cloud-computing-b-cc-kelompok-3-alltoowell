<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class ActivityLogController extends Controller
{
    protected $supabaseUrl;
    protected $supabaseKey;

    public function __construct()
    {
        $this->supabaseUrl = rtrim(config('services.supabase.url'), '/');
        $this->supabaseKey = config('services.supabase.key');
    }

    /**
     * =============================
     * INDEX — LIST SEMUA ACTIVITY
     * =============================
     */
    public function index()
    {
        $response = Http::withHeaders([
            'apikey'        => $this->supabaseKey,
            'Authorization' => 'Bearer ' . $this->supabaseKey,
        ])->get("{$this->supabaseUrl}/rest/v1/activity_logs", [
            'select' => '*',
            'order'  => 'created_at.desc',
        ]);

        if ($response->failed()) {
            abort(500, 'Gagal mengambil data activity logs dari Supabase.');
        }

        $logs = $response->json(); // Supabase return array

        return view('admin.activity.index', compact('logs'));
    }

    /**
     * =============================
     * SHOW — DETAIL ACTIVITY
     * =============================
     */
    public function show($id)
    {
        $response = Http::withHeaders([
            'apikey'        => $this->supabaseKey,
            'Authorization' => 'Bearer ' . $this->supabaseKey,
        ])->get("{$this->supabaseUrl}/rest/v1/activity_logs", [
            'id'     => 'eq.' . $id,
            'select' => '*',
        ]);

        if ($response->failed()) {
            abort(500, 'Gagal mengambil detail activity log.');
        }

        $rows = $response->json();

        if (empty($rows)) {
            abort(404, 'Data activity log tidak ditemukan.');
        }

        $log = $rows[0];

        return view('admin.activity.show', compact('log'));
    }
}
