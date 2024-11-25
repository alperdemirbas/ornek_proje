<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {

        if ($request->is('api*')) {
            $request->headers->set('Accept', 'application/json');
            return "";

        }
        if (!$request->expectsJson()) {
            if (!empty($request->subdomain)) {
                return _route('companies.login', ['subdomain' => $request->subdomain]);
            } else {
                return route('admin.view.auth.login');
            }
        }
    }
}
