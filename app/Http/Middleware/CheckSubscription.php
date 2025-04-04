<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckSubscription
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && !auth()->user()->hasActiveSubscription()) {
            if ($request->ajax()) {
                return response()->json([
                    'error' => 'Subscription required',
                    'redirect' => route('subscription.plans')
                ], 403);
            }
            
            return redirect()->route('subscription.plans')
                ->with('error', 'Please subscribe to access this feature');
        }

        return $next($request);
    }
}
