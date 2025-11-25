<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;

class ActivityLogger
{
    public static function log($action, $description, $metadata = [])
    {
        $supabaseUrl = rtrim(env('SUPABASE_URL'), '/') . '/rest/v1/activity_logs';
        $supabaseKey = env('SUPABASE_KEY');

        // AMBIL USER DARI SESSION (karena aplikasi kamu pakai session, bukan auth())
        $userId   = session('user_id');
        $userRole = session('user_role');
        $userName = session('user_name');

        Http::withHeaders([
            'apikey' => $supabaseKey,
            'Authorization' => 'Bearer ' . $supabaseKey,
            'Content-Type' => 'application/json'
        ])->post($supabaseUrl, [
            'user_id'    => $userId,       // uuid supabase user
            'action'     => $action,
            'description'=> $description,
            'metadata'   => array_merge($metadata, [
                                'role' => $userRole,
                                'name' => $userName
                            ]),
            'ip_address' => request()->ip(),
            'created_at' => now()
        ]);
    }
}
