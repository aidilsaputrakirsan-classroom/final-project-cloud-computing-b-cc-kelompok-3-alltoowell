<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use App\Helpers\ActivityLogger;

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
        $response = Http::withHeaders([
            'apikey' => $this->supabaseKey,
            'Authorization' => 'Bearer ' . $this->supabaseKey,
        ])->get("{$this->supabaseUrl}/rest/v1/{$this->table}?order=created_at.desc");

        $rooms = $response->json();

        ActivityLogger::log(
            'admin_open_rooms',
            'Admin membuka halaman daftar rooms'
        );

        return view('admin.rooms.index', compact('rooms'));
    }

    // ========================
    // CREATE
    // ========================
    public function create()
    {
        ActivityLogger::log(
            'admin_open_create_room',
            'Admin membuka halaman tambah room'
        );

        return view('admin.rooms.create');
    }

    // ========================
    // STORE (FIXED)
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

        // Upload image
        $path = $request->file('image')->store('rooms', 'public');

        // facilities JSON
        $validated['facilities'] = !empty($validated['facilities'])
            ? json_encode(array_map('trim', explode(',', $validated['facilities'])))
            : json_encode([]);

        // FIXED → payload dibuat lengkap
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

        ActivityLogger::log(
            'admin_create_room',
            'Admin menambahkan room baru',
            ['room_name' => $validated['name']]
        );

        return redirect()->route('admin.rooms.index')->with('success', 'Kamar berhasil ditambahkan.');
    }

    // ========================
    // EDIT (FIXED)
    // ========================
    public function edit($id)
    {
        $response = Http::withHeaders([
            'apikey' => $this->supabaseKey,
            'Authorization' => 'Bearer ' . $this->supabaseKey,
        ])->get("{$this->supabaseUrl}/rest/v1/{$this->table}?id=eq.$id");

        if ($response->failed() || empty($response->json())) {
            return back()->with('error', 'Kamar tidak ditemukan.');
        }

        $room = $response->json()[0];

        if (!empty($room['facilities']) && is_string($room['facilities'])) {
            $room['facilities'] = json_decode($room['facilities'], true);
        }

        ActivityLogger::log(
            'admin_open_edit_room',
            'Admin membuka halaman edit room',
            ['room_id' => $id]
        );

        return view('admin.rooms.edit', compact('room'));
    }

    // ========================
    // UPDATE
    // ========================
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'capacity' => 'required|integer',
            'status' => 'required',
            'location' => 'nullable|string',
            'description' => 'nullable|string',
            'facilities' => 'nullable|string',
            'image' => 'nullable|image'
        ]);

        $updateData = [
            'name'     => $validated['name'],
            'price'    => $validated['price'],
            'capacity' => $validated['capacity'],
            'status'   => $validated['status'],
            'location' => $validated['location'],
            'description' => $validated['description'] ?? null,
        ];

        if (!empty($validated['facilities'])) {
            $updateData['facilities'] = json_encode(array_map('trim', explode(',', $validated['facilities'])));
        }

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('rooms', 'public');
            $updateData['image'] = $path;
        }

        $response = Http::withHeaders([
            'apikey' => $this->supabaseKey,
            'Authorization' => 'Bearer ' . $this->supabaseKey,
            'Content-Type' => 'application/json',
        ])->patch("{$this->supabaseUrl}/rest/v1/{$this->table}?id=eq.$id", $updateData);

        if ($response->failed()) {
            return back()->with('error', 'Gagal memperbarui kamar: ' . $response->body());
        }

        ActivityLogger::log(
            'admin_update_room',
            'Admin memperbarui room',
            ['room_id' => $id]
        );

        return redirect()->route('admin.rooms.index')->with('success', 'Kamar berhasil diperbarui.');
    }

    // ========================
    // DELETE
    // ========================
    public function destroy($id)
    {
        Http::withHeaders([
            'apikey' => $this->supabaseKey,
            'Authorization' => 'Bearer ' . $this->supabaseKey,
        ])->delete("{$this->supabaseUrl}/rest/v1/{$this->table}?id=eq.$id");

        ActivityLogger::log(
            'admin_delete_room',
            'Admin menghapus room',
            ['room_id' => $id]
        );

        return redirect()->route('admin.rooms.index')->with('success', 'Kamar berhasil dihapus.');
    }
}
