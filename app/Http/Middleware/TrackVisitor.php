<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Visitor;
use Carbon\Carbon;

class TrackVisitor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $ip = $request->ip();
            $userAgent = $request->userAgent();
            $today = Carbon::today()->toDateString();
            
            // Jangan track request AJAX, API, atau ke rute admin
            if (!$request->ajax() && !$request->wantsJson() && !$request->is('admin*') && !$request->is('api*')) {
                $visitor = Visitor::firstOrNew([
                    'ip_address' => $ip,
                    'visited_date' => $today
                ]);
                
                $visitor->user_agent = $userAgent;
                
                if ($visitor->exists) {
                    $visitor->hits++;
                } else {
                    $visitor->hits = 1;
                }
                
                $visitor->save();
            }
        } catch (\Exception $e) {
            // Abaikan error tracking agar tidak mengganggu fungsi utama web
        }

        return $next($request);
    }
}
