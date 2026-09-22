<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Services\CyberSecurityGuard;
use Illuminate\Support\Facades\Log;

class SecurityWafMiddleware
{
    /**
     * Known malicious scanner / attack tools User-Agents
     */
    protected $blockedAgents = [
        'sqlmap', 'nikto', 'dirbuster', 'gobuster', 'wpscan', 'masscan',
        'havij', 'acunetix', 'nessus', 'arachni', 'nmap', 'zgrab',
        'morfeus', 'webinspect', 'blackwidow', 'scalp', 'sqlninja'
    ];

    /**
     * Sensitive paths commonly targeted by automated vulnerability bots
     */
    protected $probedPaths = [
        '/.env', '/.git', '/wp-login.php', '/wp-admin', '/xmlrpc.php',
        '/eval-stdin.php', '/phpmyadmin', '/pma', '/alfa.php', '/wso.php',
        '/shell.php', '/x.php', '/c99.php', '/r57.php', '/cgi-bin/',
        '/vendor/phpunit', '/solr/', '/actuator/', '/config.json',
        '/database.sql', '/backup.sql', '/dump.sql'
    ];

    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $uri = strtolower($request->getRequestUri());
        $userAgent = strtolower($request->header('User-Agent', ''));

        // 1. Block Known Attack Scanner User-Agents
        foreach ($this->blockedAgents as $agent) {
            if (strpos($userAgent, $agent) !== false) {
                CyberSecurityGuard::logThreat('SCANNER_BOT', "Blocked User-Agent: {$userAgent}");
                return response('Forbidden (Security Guard)', 403);
            }
        }

        // 2. Block Probing Paths (Exploit Scanner Defense)
        foreach ($this->probedPaths as $path) {
            if (strpos($uri, $path) !== false) {
                CyberSecurityGuard::logThreat('EXPLOIT_PROBE', "Attempted access to probed path: {$uri}");
                return response('Access Denied (Security Guard)', 403);
            }
        }

        // 3. Inspect Query Parameters for SQL Injection & XSS
        $queryParams = $request->query();
        if (!empty($queryParams)) {
            $check = CyberSecurityGuard::inspectInputs($queryParams);
            if (!$check['safe']) {
                CyberSecurityGuard::logThreat($check['threat'], "Query string attack: {$request->getQueryString()}");
                return response('Invalid request parameters detected.', 400);
            }
        }

        $response = $next($request);

        // 4. Inject Enterprise HTTP Security Headers on Response
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');
        $response->headers->set('X-XSS-Protection', '1; mode=block');
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');
        $response->headers->set('Permissions-Policy', 'camera=(), microphone=(), geolocation=()');

        return $response;
    }
}
