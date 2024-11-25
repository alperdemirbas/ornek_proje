<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class CheckLogoutConditions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check() && $request->has('_token') && $request->input('_token') !== Session::token()) {
            if (!empty($request->subdomain)) {
                return redirect(_route('companies.login', ['subdomain' => $request->subdomain]));
            } else {
                return redirect()->route('admin.view.auth.login');
            }
        }

        return $next($request);
    }
}
