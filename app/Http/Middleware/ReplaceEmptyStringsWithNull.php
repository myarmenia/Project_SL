<?php

namespace App\Http\Middleware;

use Closure;

class ReplaceEmptyStringsWithNull
{
    public function handle($request, Closure $next)
    {
        $input = $request->all();

        foreach ($input as $key => $value) {
            if ($value === "") {
                $input[$key] = null;
            }
        }

        $request->replace($input);

        return $next($request);
    }
}
