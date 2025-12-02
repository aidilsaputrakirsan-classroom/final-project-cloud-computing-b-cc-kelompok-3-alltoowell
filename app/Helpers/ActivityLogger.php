<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;

class ActivityLogger
{
    public static function log($action, $description = null, $detail = null)
    {
        if (!session()->has('user_id')) {
            return false; // Tidak log jika tidak login
        }

        $supabaseUrl = rtrim(config('services.supabase.url'), '/');
        $supabaseKey = config('services.supabase.key');

        $data = [
            'user_id'    => session('user_id'),
            'user_name'  => session('user_name'),
            'action'     => $action,
            'description'=> $description,
            'detail'     => $detail ? json_encode($detail) : null,
        ];

        Http::withHeaders([
            'apikey'        => $supabaseKey,
            'Authorization' => 'Bearer ' . $supabaseKey,
            'Content-Type'  => 'application/json'
        ])->post("{$supabaseUrl}/rest/v1/activity_logs", $data);

        return true;
    }
}
