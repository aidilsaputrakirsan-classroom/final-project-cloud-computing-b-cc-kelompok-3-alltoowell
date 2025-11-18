<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengguna;
use Illuminate\Http\Request;


class PenggunaController extends Controller
{
    public function index()
    {
        $pengguna = Pengguna::all();
        return view('admin.pengguna.index', compact('pengguna'));
    }

    public function update(Request $request, $id)
    {
        $p = Pengguna::findOrFail($id);

        // Update status sesuai input
        $p->status_checkin = $request->input('status_checkin');
        $p->save();

        // Tentukan label status untuk notifikasi
        $statusLabel = $p->status_checkin ? 'Available' : 'Unavailable';

        return redirect()->route('admin.pengguna')
                         ->with('success', "Status pengguna berhasil diperbarui menjadi $statusLabel.");
    }
}
