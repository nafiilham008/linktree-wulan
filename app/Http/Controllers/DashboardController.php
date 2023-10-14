<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Link;
use App\Http\Controllers\StatsController;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Show the dashboard.
     *
     * @return void
     */
    public function index()
    {
        $links = Link::select([
            'links.id',
            'links.title',
            'links.url',
            'links.description',
            'links.image',
            DB::raw('COUNT(clicks.id) as click_count')  // Aggregate click count for each link
        ])
            ->where('links.user_id', auth()->id())
            ->leftJoin('clicks', 'links.id', '=', 'clicks.link_id')  // Join with clicks table
            ->groupBy('links.id', 'links.title', 'links.url', 'links.description', 'links.image')  // Group by link details
            ->orderBy('links.id', 'desc')
            ->get();

        return view('dashboard', compact('links'));
    }
}
