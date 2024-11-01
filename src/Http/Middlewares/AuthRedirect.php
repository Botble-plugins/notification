<?php

namespace Botble\Notification\Http\Middlewares;

use Botble\Base\Http\Responses\BaseHttpResponse;
use Closure;
use Illuminate\Http\Request;

class AuthRedirect
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check()) {
            return $next($request);
        }

        return (new BaseHttpResponse())
                ->setCode(401)
                ->setError(true)
                ->setMessage('Unauthorized')
                ->toApiResponse();
    }
}
