<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * The app is reachable at both /{page} and /public/{page} at the server
 * level (public/ is independently web-accessible alongside the rewrite
 * that forwards clean URLs into it), so search engines have indexed both
 * as separate working pages. getRequestUri() reads the raw URI Apache/Nginx
 * received, before Symfony's routing strips the front controller's own
 * base path — that stripping is exactly why the router matches /public/about
 * as if it were /about, so checking path()/getPathInfo() here would never
 * see the prefix at all.
 *
 * The redirect is built as a raw RedirectResponse, NOT via the redirect()/
 * url() helpers. For a /public/... request, Symfony detects the front
 * controller's OWN base path as "/public" (same mechanism that made the
 * duplicate reachable in the first place) and Request::root() inherits it
 * — so redirect($target) would route through the URL generator, which
 * prepends that root, silently re-adding "/public" and looping forever.
 * A raw Location header is a literal string the browser resolves against
 * the current origin itself, sidestepping that root detection entirely.
 */
class RedirectPublicPrefix
{
    public function handle(Request $request, Closure $next): Response
    {
        $uri = $request->getRequestUri();

        if ($uri === '/public' || str_starts_with($uri, '/public/')) {
            $target = substr($uri, strlen('/public'));

            return new RedirectResponse($target === '' ? '/' : $target, 301);
        }

        return $next($request);
    }
}
