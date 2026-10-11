<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        if ($user && ($user->is_admin || in_array($user->role, ['super-admin', 'editor', 'contributor'], true))) {
            return $next($request);
        }

        return redirect('/')->with('error', 'Akses khusus kru redaksi cadas!');
    }
}
