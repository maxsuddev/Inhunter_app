<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Symfony\Component\HttpFoundation\Response;

class IsUserMiddleware
{
    /**
     * Run the request filter.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        $user = Auth::user();
        $requestedUser = $request->route('user');

        if ($user && $user->id == $requestedUser->id) {
            return $next($request);
        }

        return redirect()->route('error.forbidden');
    }
}
