<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rule;

class RoomController extends Controller
{
    protected $baseUrl;
    protected $apiKey;

    public function __construct()
    {
        $this->baseUrl = env('SUPABASE_URL') . '/rest/v1';
        $this->apiKey = env('SUPABASE_KEY');
    }

    // Ambil semua data kamar
    public function index()
    {
        $response = Http::withHeaders([
            'apikey' => $this->apiKey,
            'Authorization' => 'Bearer ' . $this->apiKey,
        ])->get("{$this->baseUrl}/rooms");

        if ($response->failed()) {
            return back()->with('error', 'Gagal mengambil data dari Supabase: ' . $response->body());
        }

        // ambil data mentah dari Supabase
        $raw = $response->json() ?? [];

        // pastikan setiap entry memiliki key 'uuid' (fallback ke 'id' bila perlu)
        $rooms = collect($raw)->map(function ($r) {
            $row = is_array($r) ? $r : (array) $r;
            if (!isset($row['uuid']) && isset($row['id'])) {
                $row['uuid'] = $row['id'];
            }
            return $row;
        })->all();

        return view('admin.rooms.index', compact('rooms'));
    }

    public function create()
    {
        return view('admin.rooms.create');
    }

    // Tambah data kamar
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'price' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'facilities' => 'nullable|string',
            'capacity' => 'required|integer|min:1|max:10',
            'location' => 'nullable|string|max:255',
            'status' => ['required', Rule::in(['available', 'occupied'])],
            'contact_owner' => 'nullable|string|max:100',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('rooms', 'public');
            $validated['image'] = '/storage/' . $path;
        }

        $response = Http::withHeaders([
            'apikey' => $this->apiKey,
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Content-Type' => 'application/json',
            'Prefer' => 'return=minimal',
        ])->post("{$this->baseUrl}/rooms", $validated);

        if ($response->failed()) {
            return back()->with('error', 'Gagal menambah data ke Supabase: ' . $response->body());
        }

        return redirect()->route('admin.rooms.index')->with('success', 'Kamar berhasil ditambahkan!');
    }

    // Edit data kamar
    public function edit($id)
    {
        $response = Http::withHeaders([
            'apikey' => $this->apiKey,
            'Authorization' => 'Bearer ' . $this->apiKey,
        ])->get("{$this->baseUrl}/rooms?id=eq.$id");

        if ($response->failed()) {
            return back()->with('error', 'Gagal mengambil data dari Supabase: ' . $response->body());
        }

        $room = $response->json()[0] ?? null;
        if (!$room) return back()->with('error', 'Data tidak ditemukan.');

        return view('admin.rooms.edit', compact('room'));
    }

    // Update data kamar
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'price' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'facilities' => 'nullable|string',
            'capacity' => 'required|integer|min:1|max:10',
            'location' => 'nullable|string|max:255',
            'status' => ['required', Rule::in(['available', 'occupied'])],
            'contact_owner' => 'nullable|string|max:100',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('rooms', 'public');
            $validated['image'] = '/storage/' . $path;
        }

        $response = Http::withHeaders([
            'apikey' => $this->apiKey,
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Content-Type' => 'application/json',
            'Prefer' => 'return=minimal',
        ])->patch("{$this->baseUrl}/rooms?id=eq.$id", $validated);

        if ($response->failed()) {
            return back()->with('error', 'Gagal memperbarui data: ' . $response->body());
        }

        return redirect()->route('admin.rooms.index')->with('success', 'Data kamar berhasil diperbarui!');
    }

    // Hapus data kamar (menggunakan HTTP request, bukan SDK)
    public function destroy($uuid)
    {
        try {
            $response = Http::withHeaders([
                'apikey' => $this->apiKey,
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
                'Prefer' => 'return=minimal',
            ])->delete("{$this->baseUrl}/rooms?uuid=eq.$uuid");

            if ($response->successful()) {
                return redirect()->route('admin.rooms.index')
                    ->with('success', 'Kamar berhasil dihapus!');
            }

            // bila gagal, tampilkan body pesan dari Supabase
            return redirect()->route('admin.rooms.index')
                ->with('error', 'Gagal menghapus kamar: ' . $response->body());
        } catch (\Exception $e) {
            return redirect()->route('admin.rooms.index')
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
