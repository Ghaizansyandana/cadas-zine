<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gig;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class GigController extends Controller
{
    public function create(): View
    {
        return view('admin.gigs.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'event_name' => 'required|string|max:255',
            'event_date' => 'required|date',
            'city' => 'required|string|max:100',
            'venue' => 'required|string|max:255',
            'ticket_price' => 'nullable|string|max:50',
            'flyer' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $posterPath = $request->file('flyer')->store('gigs', 'public');
        $isApproved = $request->user()->isSuperAdmin();

        Gig::create([
            'title' => $validated['event_name'],
            'event_date' => $validated['event_date'],
            'city' => $validated['city'],
            'venue' => $validated['venue'],
            'ticket_price' => $validated['ticket_price'] ?? 'Free',
            'poster_image' => $posterPath,
            'is_approved' => $isApproved,
        ]);

        $message = $isApproved
            ? 'Gig berhasil diterbitkan!'
            : 'Gig berhasil dikirim dan menunggu approval admin.';

        return redirect()->route('admin.dashboard')->with('success', $message);
    }
}