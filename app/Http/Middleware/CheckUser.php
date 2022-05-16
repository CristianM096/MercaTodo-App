<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class CheckUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        if (Auth::check() && auth()->user()->active == 0) {
            Auth::guard()->logout();
            $request->session()->invalidate();
            return Inertia::render('Auth/Login', [
                'status' => session('Fallo'),
                'background' => url('/storage/img/'.'Night-Sky.jpg'),
            ]);
        }
        return $response;
    }
}
