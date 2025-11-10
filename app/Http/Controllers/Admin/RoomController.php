<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RoomController extends Controller
{
    private $supabaseUrl;
    private $supabaseKey;
    private $table;

    public function __construct()
    {
        $this->supabaseUrl = rtrim(env('SUPABASE_URL'), '/');
        $this->supabaseKey = env('SUPABASE_KEY');
        $this->table = 'rooms';
    }

    /**
     * Menampilkan semua kamar
     */
    public function index()
    {
        try {
            $response = Http::withHeaders([
                'apikey' => $this->supabaseKey,
                'Authorization' => 'Bearer ' . $this->supabaseKey,
            ])->get("{$this->supabaseUrl}/rest/v1/{$this->table}?order=created_at.desc");

            if ($response->failed()) {
                return back()->with('error', 'Gagal mengambil data kamar: ' . $response->body());
            }

            $rooms = $response->json();
            return view('admin.rooms.index', compact('rooms'));

        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan koneksi: ' . $e->getMessage());
        }
    }

    /**
     * Form tambah kamar
     */
    public function create()
    {
        return view('admin.rooms.create');
    }

    /**
     * Simpan kamar baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'capacity' => 'required|integer',
            'status' => 'required|string',
            'description' => 'nullable|string',
            'facilities' => 'nullable|string',
            'location' => 'nullable|string',
            'image' => 'nullable|string',
        ]);

        // Ubah fasilitas menjadi JSON (kalau dikirim sebagai teks)
        if (!empty($validated['facilities']) && is_string($validated['facilities'])) {
            $validated['facilities'] = json_decode($validated['facilities'], true);
        }

        try {
            $response = Http::withHeaders([
                'apikey' => $this->supabaseKey,
                'Authorization' => 'Bearer ' . $this->supabaseKey,
                'Content-Type' => 'application/json',
                'Prefer' => 'return=representation',
            ])->post("{$this->supabaseUrl}/rest/v1/{$this->table}", $validated);

            if ($response->failed()) {
                return back()->with('error', 'Gagal menambah kamar: ' . $response->body());
            }

            return redirect()->route('admin.rooms.index')->with('success', 'Kamar berhasil ditambahkan.');

        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan koneksi: ' . $e->getMessage());
        }
    }

    /**
     * Form edit kamar
     */
    public function edit($id)
    {
        try {
            $response = Http::withHeaders([
                'apikey' => $this->supabaseKey,
                'Authorization' => 'Bearer ' . $this->supabaseKey,
            ])->get("{$this->supabaseUrl}/rest/v1/{$this->table}?id=eq.{$id}");

            if ($response->failed() || empty($response->json())) {
                return back()->with('error', 'Kamar tidak ditemukan.');
            }

            $room = $response->json()[0];
            return view('admin.rooms.edit', compact('room'));

        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan koneksi: ' . $e->getMessage());
        }
    }

    /**
     * Update kamar
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'capacity' => 'required|integer',
            'status' => 'required|string',
            'description' => 'nullable|string',
            'facilities' => 'nullable|string',
            'location' => 'nullable|string',
            'image' => 'nullable|string',
        ]);

        if (!empty($validated['facilities']) && is_string($validated['facilities'])) {
            $validated['facilities'] = json_decode($validated['facilities'], true);
        }

        try {
            $response = Http::withHeaders([
                'apikey' => $this->supabaseKey,
                'Authorization' => 'Bearer ' . $this->supabaseKey,
                'Content-Type' => 'application/json',
            ])->patch("{$this->supabaseUrl}/rest/v1/{$this->table}?id=eq.{$id}", $validated);

            if ($response->failed()) {
                return back()->with('error', 'Gagal memperbarui kamar: ' . $response->body());
            }

            return redirect()->route('admin.rooms.index')->with('success', 'Kamar berhasil diperbarui.');

        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan koneksi: ' . $e->getMessage());
        }
    }

    /**
     * Hapus kamar
     */
    public function destroy($id)
    {
        try {
            $response = Http::withHeaders([
                'apikey' => $this->supabaseKey,
                'Authorization' => 'Bearer ' . $this->supabaseKey,
            ])->delete("{$this->supabaseUrl}/rest/v1/{$this->table}?id=eq.{$id}");

            if ($response->failed()) {
                return back()->with('error', 'Gagal menghapus kamar: ' . $response->body());
            }

            return redirect()->route('admin.rooms.index')->with('success', 'Kamar berhasil dihapus.');

        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan koneksi: ' . $e->getMessage());
        }
    }
}
