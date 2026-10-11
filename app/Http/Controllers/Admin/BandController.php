<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Band;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BandController extends Controller
{
    public function index(Request $request)
    {
        $query = Band::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('genre', 'like', '%' . $request->search . '%')
                  ->orWhere('city', 'like', '%' . $request->search . '%');
        }

        $bands = $query->latest()->paginate(10);
        return view('admin.bands.index', compact('bands'));
    }

    public function create()
    {
        return view('admin.bands.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'genre' => 'required|string|max:255',
            'logo_or_photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $photoPath = null;
        if ($request->hasFile('logo_or_photo')) {
            $photoPath = $request->file('logo_or_photo')->store('bands', 'public');
        }

        Band::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'city' => $request->city,
            'genre' => $request->genre,
            'bio' => $request->bio,
            'logo_or_photo' => $photoPath,
            'instagram_url' => $request->instagram_url,
            'bandcamp_url' => $request->bandcamp_url,
            'spotify_url' => $request->spotify_url,
            'discography' => $request->discography,
        ]);

        return redirect()->route('admin.bands.index')->with('success', 'Band underground berhasil didaftarkan!');
    }

    public function destroy($id)
    {
        if (auth()->user()->role !== 'super-admin') {
            abort(403, 'Akses khusus Super Admin!');
        }

        $band = Band::findOrFail($id);
        if ($band->logo_or_photo) {
            Storage::disk('public')->delete($band->logo_or_photo);
        }
        $band->delete();

        return redirect()->back()->with('success', 'Data band berhasil dihapus!');
    }
}