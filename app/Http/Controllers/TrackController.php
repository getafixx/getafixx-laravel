<?php

namespace App\Http\Controllers;

use App\Models\Track;

class TrackController extends Controller
{
    /**
     * Show the getafixx tracklist homepage.
     */
    public function index()
    {
        $tracks = Track::orderByDesc('posted_at')
            ->orderByDesc('id')
            ->get();

        return view('tracks.index', ['tracks' => $tracks]);
    }
}
