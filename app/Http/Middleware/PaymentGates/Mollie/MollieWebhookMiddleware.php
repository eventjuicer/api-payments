<?php

namespace App\Http\Middleware\PaymentGates\Mollie;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MollieWebhookMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($this->isOk($payload = $request->all())) {
            return $next($request);
        } else {
            // handle all exceptions
            return abort(403, 'Forbidden');
        }
    }

    private function isOk(array $payload)
    {
        return true;
    }
}
