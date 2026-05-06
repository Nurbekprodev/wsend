<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
    public function index()
    {
        $totalUploads = DB::table('events')
            ->where('event', 'file_uploaded')
            ->count();

        $totalDownloads = DB::table('events')
            ->where('event', 'file_downloaded')
            ->count();

        $uploadsPerDay = DB::table('events')
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->where('event', 'file_uploaded')
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        $uploadLabels = $uploadsPerDay->pluck('date');
        $uploadCounts = $uploadsPerDay->pluck('count');

        $activeUsers = DB::table('events')
            ->where('created_at', '>=', now()->subDays(7))
            ->whereNotNull('user_id')
            ->distinct()
            ->count('user_id');

        $downloadsPerDay = DB::table('events')
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->where('event', 'file_downloaded')
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        $downloadLabels = $downloadsPerDay->pluck('date');
        $downloadCounts = $downloadsPerDay->pluck('count');

        $totalStorage = DB::table('files')->sum('file_size');

        return view('admin.analytics', [
            'totalUploads' => $totalUploads,
            'totalDownloads' => $totalDownloads,
            'activeUsers' => $activeUsers,
            'uploadLabels' => $uploadLabels,
            'uploadCounts' => $uploadCounts,
            'downloadLabels' => $downloadLabels,
            'downloadCounts' => $downloadCounts,
            'totalStorage' => $totalStorage,
        ]);
    }
}
