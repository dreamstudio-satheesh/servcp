<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;

class SubdomainDatabaseSwitcher
{
    public function handle($request, Closure $next)
    {
        $host = $request->getHost(); // e.g., mistore.servcp.com
        $mainDomain = config('app.main_domain'); // servcp.com
        $subdomain = str_replace(".{$mainDomain}", '', $host);

        // Check if it's the main domain
        if ($host === $mainDomain) {
            return $next($request);
        }

        // Query subdomain database mapping
        $mapping = DB::table('subdomains')->where('subdomain', $subdomain)->first();

        if (!$mapping) {
            // Handle invalid subdomains
            return response()->view('errors.subdomain_not_found', [], 404);
        }

        // Set the tenant database
        config(['database.connections.tenant.database' => $mapping->database_name]);
        DB::reconnect('tenant');

        return $next($request);
    }
}
