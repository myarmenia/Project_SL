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
        'http://sl.test/*',
        'http://127.0.0.1:8000/*',
        'http://localhost:8000/*',
        'http://127.0.0.1:8080/*',
        'http://project-sl.loc/*',
        'http://myarmenia.test/*',
        'http://83.139.22.66/*',
        'https://172-105-75-47.ip.linodeusercontent.com/*',
        'http://192.168.6.50/*',
    ];
}
