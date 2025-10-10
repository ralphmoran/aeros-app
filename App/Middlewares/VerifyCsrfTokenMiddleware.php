<?php

namespace App\Middlewares;

use Aeros\Src\Classes\Request;
use Aeros\Src\Classes\Response;
use Aeros\Src\Interfaces\MiddlewareInterface;

class VerifyCsrfTokenMiddleware implements MiddlewareInterface
{
    /**
     * Routes exempt from CSRF validation
     */
    protected array $except = [];

    public function __construct()
    {
        $this->except = config('security.csrf_exempt_routes', []);
    }

    public function __invoke(Request $request, Response $response)
    {
        // Skip for GET, HEAD, OPTIONS
        if (in_array(request()->getHttpMethod(), ['GET', 'HEAD', 'OPTIONS'])) {
            return;
        }

        // Skip for exempted routes
        if ($this->isExempt(request()->getURI())) {
            return;
        }

        // For JSON API: validate Bearer token
        if (request()->isJson()) {
            if (! app()->security->validateBearerToken()) {
                abort('401 Unauthorized - Invalid or missing Bearer token', 401);
            }

            return;
        }

        // Validate CSRF token
        $token = app()->security->getCsrfTokenFromRequest();

        if (! app()->security->validateCsrfToken($token)) {
            abort('403 Forbidden - CSRF token validation failed');
        }
    }

    /**
     * Check if current route is exempt from CSRF.
     *
     * @param   string  $uri
     * @return  bool
     */
    private function isExempt(string $uri): bool
    {
        foreach ($this->except as $pattern) {
            if (fnmatch($pattern, $uri)) {
                return true;
            }
        }

        return false;
    }
}
