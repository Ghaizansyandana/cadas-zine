<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gig;
use App\Models\LostAndFound;

class ApprovalController extends Controller
{
    public function index()
    {
        $pendingGigs = Gig::where('is_approved', false)->latest()->get();
        $pendingPits = LostAndFound::where('is_approved', false)->latest()->get();

        return view('admin.approvals.index', compact('pendingGigs', 'pendingPits'));
    }

    public function approveGig($id)
    {
        Gig::findOrFail($id)->update(['is_approved' => true]);
        return back()->with('success', 'Agenda Gig berhasil diloloskan ke web!');
    }

    public function rejectGig($id)
    {
        Gig::findOrFail($id)->delete();
        return back()->with('success', 'Submitan Gig dibantai / ditolak!');
    }

    public function approvePit($id)
    {
        LostAndFound::findOrFail($id)->update(['is_approved' => true]);
        return back()->with('success', 'Laporan Pit Board terbit di web!');
    }

    public function rejectPit($id)
    {
        LostAndFound::findOrFail($id)->delete();
        return back()->with('success', 'Laporan Pit dibantai / ditolak!');
    }
}