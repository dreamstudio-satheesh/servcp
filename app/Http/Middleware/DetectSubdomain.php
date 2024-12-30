<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;

class DetectSubdomain
{
    public function handle($request, Closure $next)
    {
        $host = $request->getHost(); // e.g., servcp.com or abc.servcp.com
        $mainDomain = config('app.main_domain'); // servcp.com
        $subdomain = str_replace(".{$mainDomain}", '', $host);

        if ($host === $mainDomain) {
            // Main domain logic
            config(['app.is_main_domain' => true]);
        } else {
            // Subdomain logic
            $mapping = DB::table('subdomains')->where('subdomain_name', $subdomain)->first();

            if (!$mapping) {
                return response()->view('errors.subdomain_not_found', [], 404);
            }

            // Set tenant database dynamically
            config(['database.connections.mysql.database' => $mapping->database_name]);
            DB::reconnect();
            config(['app.is_main_domain' => false]);
        }

        return $next($request);
    }
}
