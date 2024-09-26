<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Candidates;

class CheckUserCandidate
{
    public function handle(Request $request, Closure $next)
    {
        $candidateId = $request->input('candidate_id');
        $candidate = Candidates::findOrFail($candidateId);

        if (auth()->check() && auth()->user()->id === $candidate->user_id) {
            return $next($request);
        }

        return redirect()->route('error.forbidden')->with('error', 'You are not authorized to update this candidate');
    }
}

