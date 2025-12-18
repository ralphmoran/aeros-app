<?php

namespace App\Providers;

use Aeros\Src\Classes\ServiceProvider;

class CorsWhitelistServiceProvider extends ServiceProvider
{
    public function register(): void { }

    public function boot(): void {}

    /**
     * Get all allowed origins from cache.
     *
     * @return array
     */
    public function getAllowedOrigins(): array
    {
        $cached = cache('redis')->get(env('CACHE_KEY'));

        if ($cached !== null) {
            return json_decode($cached, true) ?: [];
        }

        // Initialize with default origins from config
        $defaultOrigins = config('cors.default_allowed_origins', [
            env('HTTP_URL')
        ]);

        $this->setAllowedOrigins($defaultOrigins);

        return $defaultOrigins;
    }

    /**
     * Set allowed origins in cache.
     *
     * @param array $origins
     * @return bool
     */
    public function setAllowedOrigins(array $origins): bool
    {
        cache('redis')->set(
            env('CACHE_KEY'),
            json_encode(array_values($origins)),
            'ex',
            env('CACHE_TTL'),
            'nx'
        );

        return true;
    }

    /**
     * Add an origin to the whitelist.
     *
     * @param string $origin
     * @return bool
     */
    public function addOrigin(string $origin): bool
    {
        if (! $this->isValidOrigin($origin)) {
            return false;
        }

        $origins = $this->getAllowedOrigins();

        if (! in_array($origin, $origins)) {
            $origins[] = $origin;
            return $this->setAllowedOrigins($origins);
        }

        return true;
    }

    /**
     * Remove an origin from the whitelist.
     *
     * @param string $origin
     * @return bool
     */
    public function removeOrigin(string $origin): bool
    {
        $filtered = array_filter(
            $this->getAllowedOrigins(),
            fn($o) => $o !== $origin
        );

        return $this->setAllowedOrigins($filtered);
    }

    /**
     * Check if origin is in the whitelist.
     *
     * @param string $origin
     * @return bool
     */
    public function isOriginAllowed(string $origin): bool
    {
        if (empty($origin)) {
            return false;
        }

        $allowedOrigins = $this->getAllowedOrigins();

        // Direct match
        if (in_array($origin, $allowedOrigins)) {
            return true;
        }

        // Pattern match (e.g., *.corenexus.test matches any.corenexus.test)
        foreach ($allowedOrigins as $allowed) {
            if ($this->matchesPattern($origin, $allowed)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Check if origin matches pattern (supports wildcards for domains and IPs).
     *
     * @param string $origin
     * @param string $pattern
     * @return bool
     */
    private function matchesPattern(string $origin, string $pattern): bool
    {
        if (! str_contains($pattern, '*')) {
            return $origin === $pattern;
        }

        // Escape special regex characters, then replace \* with .*
        $escaped = preg_quote($pattern, '/');
        $regex = '/^' . str_replace('\*', '.*', $escaped) . '$/';

        return preg_match($regex, $origin) === 1;
    }

    /**
     * Validate origin format (supports domains and IPs with ports).
     *
     * @param string $origin
     * @return bool
     * @example
     * <code>
     * <?php
     *   Valid patterns:
     *  - domain.com
     *  - *.domain.com (wildcard)
     *  - 127.0.0.1
     *  - 192.168.1.* (IP wildcard)
     *  - Any of above with :port
     * ?>
     * </code>
     */
    private function isValidOrigin(string $origin): bool
    {
        // Must start with http:// or https://
        if (!preg_match('/^https?:\/\/.+/', $origin)) {
            return false;
        }

        // Must not end with /
        if (substr($origin, -1) === '/') {
            return false;
        }

        // Extract the host part (after protocol, before path)
        $parsed = parse_url($origin);

        if (!isset($parsed['host'])) {
            return false;
        }

        return true;
    }
}
