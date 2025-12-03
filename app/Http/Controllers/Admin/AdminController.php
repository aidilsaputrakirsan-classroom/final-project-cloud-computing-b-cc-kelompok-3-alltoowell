<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Menampilkan halaman dashboard admin
    public function index()
    {
        return view('admin.dashboard');
    }

    // Menampilkan daftar penyewa (contoh)
    public function penyewa()
    {
        return view('admin.penyewa');
    }

    // Update status penyewa (contoh)
    public function updateStatus(Request $request, $id)
    {
        // Logika update status penyewa di sini
        // Contoh:
        // $status = $request->input('status');
        // User::find($id)->update(['status' => $status]);

        return redirect()->back()->with('success', 'Status penyewa berhasil diperbarui.');
    }
}
