<?php

namespace App\Middlewares;

use Aeros\Src\Classes\Request;
use Aeros\Src\Classes\Response;
use Aeros\Src\Classes\RateLimiter;
use Aeros\Src\Interfaces\MiddlewareInterface;

class RateLimiterMiddleware implements MiddlewareInterface
{
    public function __invoke(Request $request, Response $response)
    {
        // Get configuration
        $maxAttempts = config('security.rate_limit.max_attempts', 60);
        $decayMinutes = config('security.rate_limit.decay_minutes', 1);

        // Create unique key (by IP and route)
        $key = RateLimiter::keyByRoute(
            request()->getURI(),
            RateLimiter::keyByIP()
        );

        try {
            app()->rateLimiter->throttle($key, $maxAttempts, $decayMinutes, function($limiter) use ($key) {
                // Optional: Log rate limit violation
                logger(
                    "Rate limit exceeded for key: {$key}",
                    'security.log'
                );
            });

            // Add rate limit headers to response
            $this->addRateLimitHeaders(app()->rateLimiter, $key, $maxAttempts);

        } catch (\Exception $e) {
            // Add headers showing limit exceeded
            $this->addRateLimitHeaders(app()->rateLimiter, $key, $maxAttempts);

            abort([
                'error' => 'Too Many Requests',
                'message' => $e->getMessage(),
                'retry_after' => app()->rateLimiter->availableIn($key)
            ], 429);
        }
    }

    /**
     * Add rate limit headers to response.
     *
     * @param RateLimiter $limiter
     * @param string $key
     * @param int $maxAttempts
     */
    private function addRateLimitHeaders(RateLimiter $limiter, string $key, int $maxAttempts): void
    {
        header('X-RateLimit-Limit: ' . $maxAttempts);
        header('X-RateLimit-Remaining: ' . $limiter->remaining($key, $maxAttempts));

        if ($limiter->tooManyAttempts($key, $maxAttempts, 1)) {
            header('Retry-After: ' . $limiter->availableIn($key));
        }
    }
}