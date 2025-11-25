<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ActivityLogger;

class AdminController extends Controller
{
    public function index()
    {
        ActivityLogger::log(
            'admin_open_dashboard',
            'Admin membuka halaman dashboard'
        );

        return view('admin.dashboard');
    }

    public function penyewa()
    {
        ActivityLogger::log(
            'admin_open_penyewa',
            'Admin membuka halaman daftar penyewa'
        );

        return view('admin.penyewa');
    }

    public function updateStatus(Request $request, $id)
    {
        // proses update status…

        ActivityLogger::log(
            'admin_update_penyewa_status',
            'Admin memperbarui status penyewa',
            [
                'penyewa_id' => $id,
                'new_status' => $request->status
            ]
        );

        return redirect()->back()->with('success', 'Status penyewa berhasil diperbarui.');
    }
}
