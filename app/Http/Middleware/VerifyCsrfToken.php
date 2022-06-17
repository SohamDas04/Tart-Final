<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        //
        '/signup','/email/verify','/login','/check','/dashboard','/csrf','/uploadp','/uploacp','/createdu','/preview','/postit','/notpostit','/search','/viewpeople','/showpeople','/requestsend','/notifyrequest',
    ];
}
