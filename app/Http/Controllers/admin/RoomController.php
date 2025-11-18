<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class RoomController extends Controller
{
    private $supabaseUrl;
    private $supabaseKey;
    private $table = 'rooms';

    public function __construct()
    {
        $this->supabaseUrl = rtrim(env('SUPABASE_URL'), '/');
        $this->supabaseKey = env('SUPABASE_KEY');
    }

    // ========================
    // INDEX - tampil semua kamar
    // ========================
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

            // convert facilities dari JSON string ke array
            foreach ($rooms as &$room) {
                if (!empty($room['facilities']) && is_string($room['facilities'])) {
                    $room['facilities'] = json_decode($room['facilities'], true);
                }
            }

            return view('admin.rooms.index', compact('rooms'));
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan koneksi: ' . $e->getMessage());
        }
    }

    // ========================
    // CREATE - form tambah kamar
    // ========================
    public function create()
    {
        return view('admin.rooms.create');
    }

    // ========================
    // STORE - simpan kamar baru
    // ========================
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
            'image' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
        ]);

        // =====================
        // Upload gambar LOKAL
        // =====================
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/rooms', $filename);

            // simpan NAMA FILE saja, bukan /storage/rooms/...
            $validated['image'] = $filename;
        } else {
            $validated['image'] = null;
        }

        // Konversi facilities string ke JSON array
        if (!empty($validated['facilities'])) {
            $validated['facilities'] = json_encode(
                array_map('trim', explode(',', $validated['facilities']))
            );
        }

        // =====================
        // Simpan ke Supabase
        // =====================
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

    // ========================
    // EDIT
    // ========================
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

            if (!empty($room['facilities']) && is_string($room['facilities'])) {
                $room['facilities'] = json_decode($room['facilities'], true);
            }

            return view('admin.rooms.edit', compact('room'));
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan koneksi: ' . $e->getMessage());
        }
    }

    // ========================
    // UPDATE
    // ========================
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
            'image' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Upload gambar baru jika ada
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/rooms', $filename);
            $validated['image'] = $filename;
        } else {
            unset($validated['image']); // jangan update kolom image
        }

        if (!empty($validated['facilities'])) {
            $validated['facilities'] = json_encode(
                array_map('trim', explode(',', $validated['facilities']))
            );
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

    // ========================
    // DESTROY
    // ========================
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
