<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class SectionSelectionMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->username === 'Work.stud' && empty($user->section)) {
                $path = $request->path();
                $allowedPaths = ['e-periodical-index', 'section/select'];

                $isAllowed = in_array($path, $allowedPaths) || $request->is('section/select');

                if (!$isAllowed) {
                    return redirect()->route('e-periodical.index');
                }
            }
        }

        return $next($request);
    }
}
