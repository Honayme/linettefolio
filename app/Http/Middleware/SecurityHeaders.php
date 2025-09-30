<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeaders
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Headers de sécurité essentiels
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('X-Frame-Options', 'DENY');
        $response->headers->set('X-XSS-Protection', '1; mode=block');
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');

        // HSTS - Uniquement en HTTPS
        if ($request->isSecure()) {
            $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains; preload');
        }

        // CSP - Content Security Policy
        $csp = [
            "default-src 'self'",
            "script-src 'self' 'unsafe-inline' 'unsafe-eval' https://fonts.googleapis.com https://fonts.gstatic.com https://rsms.me",
            "style-src 'self' 'unsafe-inline' https://fonts.googleapis.com https://fonts.gstatic.com https://rsms.me",
            "img-src 'self' data: https:",
            "font-src 'self' https://fonts.gstatic.com https://rsms.me",
            "connect-src 'self'",
            "media-src 'self'",
            "object-src 'none'",
            "frame-src 'self' https://maps.google.com",
            "base-uri 'self'",
            "form-action 'self'"
        ];

        $response->headers->set('Content-Security-Policy', implode('; ', $csp));

        // Permissions Policy (anciennement Feature Policy)
        $permissionsPolicy = [
            'geolocation=()',
            'microphone=()',
            'camera=()',
            'fullscreen=(self)',
            'payment=()',
            'usb=()',
            'magnetometer=()',
            'gyroscope=()',
            'accelerometer=()'
        ];

        $response->headers->set('Permissions-Policy', implode(', ', $permissionsPolicy));

        return $response;
    }
}
