<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $links = Link::latest()->get();

        $slider = Link::join('clicks', 'links.id', '=', 'clicks.link_id')
            ->orderBy('clicks.attempts', 'desc')
            ->select('links.*') // Memastikan kita hanya mengambil kolom dari tabel links
            ->limit(3)
            ->get();

        return view('welcome', compact('links', 'slider'));
    }
}
