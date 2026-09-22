<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Http\Controllers\SecurityVerificationController;

class BotChallengeGatekeeper
{
    /**
     * Paths that should be exempted from the bot challenge check.
     */
    protected $except = [
        'security/*',
        'admin/*',
        'admin',
        'storage/*',
        'uploads/*',
        'favicon.ico',
        'robots.txt',
    ];

    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // 1. Check if route is exempted
        foreach ($this->except as $pattern) {
            if ($request->is($pattern)) {
                return $next($request);
            }
        }

        // 2. Logged-in admin/user bypass
        if (auth()->check()) {
            return $next($request);
        }

        // 3. Check if human has already passed verification
        if (SecurityVerificationController::isVerified($request)) {
            return $next($request);
        }

        // 4. If AJAX request, return JSON instruction
        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'error'                => 'Security verification required',
                'require_verification' => true,
                'redirect'             => route('security.verification')
            ], 403);
        }

        // 5. Save intended destination and redirect to verification screen
        if ($request->isMethod('GET')) {
            session(['security_intended_url' => $request->fullUrl()]);
        }

        return redirect()->route('security.verification');
    }
}
