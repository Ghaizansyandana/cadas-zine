<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Band;
use App\Models\Gig;
use App\Models\LostAndFound;
use App\Models\Post;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();

        // 1. KONDISI UNTUK SUPER ADMIN
        if ($user->isSuperAdmin()) {
            $totalPosts = Post::count();
            $totalBands = Band::count();

            // Hitung total pending approval (Posts + Gigs + Pit Board)
            $pendingPosts = Post::where('is_approved', false)->count();
            $pendingGigs = Gig::where('is_approved', false)->count();
            $pendingPits = LostAndFound::where('is_approved', false)->count();

            $totalPending = $pendingPosts + $pendingGigs + $pendingPits;

            return view('admin.dashboard', compact(
                'totalPosts',
                'totalBands',
                'totalPending',
                'pendingPosts',
                'pendingGigs',
                'pendingPits'
            ));
        }

        // 2. KONDISI UNTUK KONTRIBUTOR / EDITOR
        // Cuma ngambil data postingan milik user yang lagi login
        $myPosts = Post::where('user_id', $user->id)->latest()->get();
        $myTotalPosts = $myPosts->count();
        $myPendingPosts = $myPosts->where('is_approved', false)->count();
        $myApprovedPosts = $myPosts->where('is_approved', true)->count();

        return view('admin.dashboard-contributor', compact(
            'myPosts',
            'myTotalPosts',
            'myPendingPosts',
            'myApprovedPosts'
        ));
    }
}
