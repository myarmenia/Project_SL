<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        $language = $request->locale;
        if (!in_array($language, ['ru', 'am'])) {
            \abort(400);
        }

        // $arr = [];

        // if (session()->has('arr_url')) {
        //     $arr = Session::get('arr_url');
        // }
        // $currentURL = url()->current();
        // $url = explode("$language", url()->current())[1];
        // // dd( $arr);
        // $found = array_filter($arr, function ($v, $k) use ($url) {
        //     return $v['url'] == $url;
        // }, ARRAY_FILTER_USE_BOTH);


        // if (count($found) > 0) {
        //     $arr = array_slice($arr, 0, array_keys($found)[0]);
        // }
        // if (!str_contains($currentURL, 'create')) {
        //     if (request()->segment(2) == 'open') {
        //         $arr_asoc['url'] = $url;
        //         $arr_asoc['name'] = request()->segment(3);
        //         array_push($arr, $arr_asoc);
        //     }

        //     if (request()->segment(2) == 'dictionary') {
        //         $arr_asoc['url'] = $url;
        //         $arr_asoc['name'] = request()->segment(3);
        //         $arr[0] = $arr_asoc;
        //     }
        //     if (!str_contains($currentURL, 'edit')) {
        //         $arr_asoc['url'] = $url;
        //         $arr_asoc['name'] = request()->segment(2);
        //         $arr_asoc['id'] = request()->segment(3);
        //         array_push($arr, $arr_asoc);
        //     }




        //     Session::put('arr_url', $arr);
        // }
        // dd(Session::get('arr_url'));
        App::setLocale($language);
        URL::defaults(['locale' => app()->getLocale()]);
        return $next($request);
    }
}
