<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(10);

        return view('admin.users.index', compact('users'));
    }

    public function updateRole(Request $request, User $user)
    {
        $request->validate([
            'role' => ['required', 'in:super-admin,editor,contributor'],
        ]);

        $user->update([
            'role' => $request->role,
        ]);

        return back()->with('success', "Role user {$user->name} berhasil diubah ke {$request->role}!");
    }

    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->withErrors('Lu gak bisa hapus akun sendiri, bro!');
        }

        $user->delete();

        return back()->with('success', 'User berhasil ditendang dari sistem!');
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', Rules\Password::defaults()],
            'role' => ['required', 'in:super-admin,editor,contributor'],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User baru berhasil dibuat!');
    }
}
