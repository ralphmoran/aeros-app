<?php

namespace App\Middlewares;

use Aeros\Src\Classes\Request;
use Aeros\Src\Classes\Response;
use Aeros\Src\Interfaces\MiddlewareInterface;

class VerifyCsrfTokenMiddleware implements MiddlewareInterface
{
    public function __invoke(Request $request, Response $response)
    {
        // Skip for non-state-changing methods
        if (! in_array(request()->getHttpMethod(), ['POST', 'PUT', 'PATCH', 'DELETE'])) {
            return;
        }

        // Get CSRF token from request body or header
        $requestToken = request()->csrf_token ?? $this->getTokenFromHeaders();

        if (empty($requestToken)) {
            abort('403 Forbidden - CSRF token missing');
        }

        if (! hash_equals((string) session()->csrf_token, $requestToken)) {
            abort('403 Forbidden - CSRF token mismatch');
        }
    }

    /**
     * Get CSRF token from request headers.
     */
    private function getTokenFromHeaders(): ?string
    {
        $headers = request()->getHeaders();

        foreach ($headers as $header) {
            if (stripos($header, 'X-CSRF-TOKEN:') === 0) {
                return trim(substr($header, 13));
            }
        }

        return null;
    }
}
