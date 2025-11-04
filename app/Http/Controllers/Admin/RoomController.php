<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class RoomController extends Controller
{
    // ✅ Tidak menggunakan middleware login
    public function index(Request $request)
    {
        $query = Room::query();

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('location', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $rooms = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.rooms.index', compact('rooms'));
    }

    public function create()
    {
        return view('admin.rooms.create');
    }

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

        // 🖼️ Simpan gambar ke folder public/storage/rooms
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('rooms', 'public');
            $validated['image'] = '/storage/' . $path;
        }

        // 🚀 Simpan ke database
        Room::create($validated);

        return redirect()->route('admin.rooms.index')
            ->with('success', 'Kamar berhasil ditambahkan!');
    }

    public function edit(Room $room)
    {
        return view('admin.rooms.edit', compact('room'));
    }

    public function update(Request $request, Room $room)
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

        // 🖼️ Ganti gambar lama (jika ada)
        if ($request->hasFile('image')) {
            if ($room->image && file_exists(public_path($room->image))) {
                unlink(public_path($room->image));
            }
            $path = $request->file('image')->store('rooms', 'public');
            $validated['image'] = '/storage/' . $path;
        }

        // 🔄 Update data
        $room->update($validated);

        return redirect()->route('admin.rooms.index')
            ->with('success', 'Kamar berhasil diperbarui!');
    }

    public function destroy(Room $room)
    {
        // 🗑️ Hapus gambar (jika ada)
        if ($room->image && file_exists(public_path($room->image))) {
            unlink(public_path($room->image));
        }

        $room->delete();
        return back()->with('success', 'Kamar dihapus!');
    }
}
