<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Gig;
use App\Models\Band;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'posts' => Post::count(),
            'gigs' => Gig::count(),
            'bands' => Band::count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
