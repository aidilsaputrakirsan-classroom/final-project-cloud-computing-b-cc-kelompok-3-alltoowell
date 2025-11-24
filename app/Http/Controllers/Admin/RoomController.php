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
    // INDEX
    // ========================
    public function index()
    {
        try {
            $response = Http::withHeaders([
                'apikey' => $this->supabaseKey,
                'Authorization' => 'Bearer ' . $this->supabaseKey,
            ])->get("{$this->supabaseUrl}/rest/v1/{$this->table}?order=created_at.desc");

            if ($response->failed()) {
                return back()->with('error', 'Gagal mengambil data kamar: Internal server error.');
            }

            $rooms = $response->json();

            foreach ($rooms as &$room) {
                if (!empty($room['facilities']) && is_string($room['facilities'])) {
                    $room['facilities'] = json_decode($room['facilities'], true);
                }
            }

            return view('admin.rooms.index', compact('rooms'));
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // ========================
    // CREATE
    // ========================
    public function create()
    {
        return view('admin.rooms.create');
    }

    // ========================
    // STORE
    // ========================
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'capacity' => 'required|integer',
            'status' => 'required',
            'location' => 'required',
            'facilities' => 'nullable|string',
            'image' => 'required|image'
        ]);

        // Upload image ke storage lokal
        $path = $request->file('image')->store('rooms', 'public');

        // JSON facilities
        $validated['facilities'] = !empty($validated['facilities'])
            ? json_encode(array_map('trim', explode(',', $validated['facilities'])))
            : json_encode([]);

        // Simpan ke Supabase (image = rooms/xxx.jpg)
        $payload = [
            'name'       => $validated['name'],
            'price'      => $validated['price'],
            'capacity'   => $validated['capacity'],
            'status'     => $validated['status'],
            'location'   => $validated['location'],
            'facilities' => $validated['facilities'],
            'image'      => $path
        ];

        $response = Http::withHeaders([
            'apikey' => $this->supabaseKey,
            'Authorization' => 'Bearer ' . $this->supabaseKey,
            'Content-Type' => 'application/json',
            'Prefer' => 'return=minimal'
        ])->post("{$this->supabaseUrl}/rest/v1/{$this->table}", $payload);

        if ($response->failed()) {
            return back()->with('error', 'Gagal menyimpan kamar: ' . $response->body());
        }

        return redirect()->route('admin.rooms.index')->with('success', 'Kamar berhasil ditambahkan.');
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
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
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
            'image' => 'nullable|image|max:2048',
        ]);

        $updateData = [
            'name'     => $validated['name'],
            'price'    => $validated['price'],
            'capacity' => $validated['capacity'],
            'status'   => $validated['status'],
            'location' => $validated['location'],
            'description' => $validated['description'] ?? null,
        ];

        // facilities
        if (!empty($validated['facilities'])) {
            $updateData['facilities'] = json_encode(
                array_map('trim', explode(',', $validated['facilities']))
            );
        }

        // Jika upload gambar baru
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('rooms', 'public');
            $updateData['image'] = $path;
        }

        $response = Http::withHeaders([
            'apikey' => $this->supabaseKey,
            'Authorization' => 'Bearer ' . $this->supabaseKey,
            'Content-Type' => 'application/json',
        ])->patch("{$this->supabaseUrl}/rest/v1/{$this->table}?id=eq.{$id}", $updateData);

        if ($response->failed()) {
            return back()->with('error', 'Gagal memperbarui kamar: ' . $response->body());
        }

        return redirect()->route('admin.rooms.index')->with('success', 'Kamar berhasil diperbarui.');
    }

    // ========================
    // DELETE
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
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
