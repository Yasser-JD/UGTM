<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackVisits
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->isMethod('GET') && 
            !$request->is('admin*') && 
            !$request->is('api*') && 
            !$request->is('livewire*') && 
            !$request->is('filament*') &&
            !$request->ajax()) {
            
            \App\Models\Visit::create([
                'ip_address' => $request->ip(),
                'url' => $request->fullUrl(),
                'user_id' => auth()->id(),
                'user_agent' => $request->userAgent(),
            ]);
        }

        return $next($request);
    }
}
