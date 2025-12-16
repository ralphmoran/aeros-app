<?php

namespace App\Middlewares;

use Aeros\Src\Classes\Request;
use Aeros\Src\Classes\Response;
use Aeros\Src\Interfaces\MiddlewareInterface;

class CorsValidationMiddleware implements MiddlewareInterface
{
    public function __invoke(Request $request, Response $response)
    {
        $origin = $request->getHeaderValue('Origin');

        // Skip if no origin header (same-origin requests)
        if (empty($origin)) {
            return;
        }

        if (! cors()->isOriginAllowed($origin)) {
            abort('Origin not allowed');
        }
    }
}
