<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

if (!function_exists('track_event')) {
    function track_event($event, $metadata = [])
    {
        DB::table('events')->insert([
            'user_id' => Auth::id(),
            'event' => $event,
            'metadata' => json_encode($metadata),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}