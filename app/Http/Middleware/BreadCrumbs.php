<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BreadCrumbs
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        //Хлебные крошки
        $language = $request->locale;
        $crumbs = [];
        // session()->forget('crumbs_url');

        $currentURL = url()->current();
        $url = explode("$language", url()->current())[1];
        $uri = request()->getRequestUri();
        // dd($url);
        // dd(request());
        if (str_contains($uri, '?') || str_contains($currentURL, 'edit') || str_contains($currentURL, 'create') || str_contains($currentURL, 'fusion')) {
            if (session()->has('crumbs_url')) {
                $crumbs = Session::get('crumbs_url');
            }


            // if (request()->segment(2) == 'open' && !str_contains($uri, '?')) {
            //     $url_page = explode("open/", $url)[1];

            //     if (str_contains(url()->previous(), $url_page)) {


            //         if (session()->has('crumbs_url')) {
            //             $crumbs = Session::get('crumbs_url');
            //         }
            //     }
            // } else {

            //     if (session()->has('crumbs_url') ) {
            //         $crumbs = Session::get('crumbs_url');
            //     }


            // }



            // $found = array_filter($crumbs, function ($v, $k) use ($url) {
            //     return $v['url'] == $url;
            // }, ARRAY_FILTER_USE_BOTH);


            // if (count($found) > 0) {
            //     $crumbs = array_slice($crumbs, 0, array_keys($found)[0]);
            // }
            // if(str_contains($currentURL, 'edit')){
            //     $arr_asoc['title'] = request()->segment(2) ?? 'aaaa';
            //     $arr_asoc['url'] = $url;
            //     $arr_asoc['name'] = request()->segment(2);
            //     $arr_asoc['id'] = request()->segment(3);
            //     array_push($crumbs, $arr_asoc);
            // }
            // else{

            //     $arr_asoc['title'] = 'open';
            //     $arr_asoc['url'] = $url;
            //     $arr_asoc['name'] = request()->segment(3);

            //     array_push($crumbs, $arr_asoc);
            // }



        }
        else{
            // session()->forget('crumbs_url');

        }
        // if (!str_contains($uri, '?')) {

        //     if (request()->segment(2) == 'open') {
        //         $url_page = explode("open/", $url)[1];

        //         if (str_contains(url()->previous(), $url_page)) {
        if (str_contains($uri, '?')) {
            $url = explode("$language", $uri)[1];
        }

        $found = array_filter($crumbs, function ($v, $k) use ($url) {
            return $v['url'] == $url;
        }, ARRAY_FILTER_USE_BOTH);


        if (count($found) > 0) {

            $crumbs = array_slice($crumbs, 0, array_keys($found)[0]);
        }
        //     }
        //     }
        // }

        //    dd($crumbs);
        // if (!str_contains($currentURL, 'create')) {
        if (request()->segment(2) == 'open') {
            // $url_page = explode("open/", $url)[1];

            // if (!str_contains(url()->previous(), $url_page)) {

            //     session()->forget('crumbs_url');
            // }
            // else{
            //     if (session()->has('crumbs_url')) {
            //         $crumbs = Session::get('crumbs_url');
            //     }
            // }
            // if (!str_contains($currentURL, 'create')) {


            $arr_asoc['title'] = 'open';
            $arr_asoc['url'] = $url;
            $arr_asoc['name'] = request()->segment(3);

            array_push($crumbs, $arr_asoc);
            // }
            // $crumbs = array_slice($crumbs, 0, 1);

        } else if (request()->segment(2) == 'dictionary') {
            session()->forget('crumbs_url');

            $arr_asoc['title'] = 'dictionary';
            $arr_asoc['url'] = $url;
            $arr_asoc['name'] = request()->segment(3);
            $crumbs[0] = $arr_asoc;
            // $crumbs = array_slice($crumbs, 0, 1);
        } else if (request()->segment(2) == 'bibliography') {
            session()->forget('crumbs_url');

            // $arr_asoc['title'] = 'dictionary';
            // $arr_asoc['url'] = $url;
            // $arr_asoc['name'] = request()->segment(3);
            // $crumbs[0] = $arr_asoc;
            // $crumbs = array_slice($crumbs, 0, 1);
        } else {

            if (!str_contains($currentURL, 'edit') && !str_contains($currentURL, 'create')) {
                $arr_asoc['title'] = request()->segment(2);
                $arr_asoc['url'] = $url;
                $arr_asoc['name'] = request()->segment(3);


                if (request()->segment(3) == 'fusion' && request()->segment(4)) {
                    $arr_asoc['name'] = request()->segment(4);
                }

                array_push($crumbs, $arr_asoc);

            }
        }
        if (str_contains($currentURL, 'create')) {
            $arr_asoc['title'] = request()->segment(2) ?? 'aaaa';
            $arr_asoc['url'] = $url;
            // $arr_asoc['name'] = request()->segment(3);
            $arr_asoc['name'] = 'create';

            array_push($crumbs, $arr_asoc);
        }
        if (str_contains($currentURL, 'edit')) {
            // session()->forget('crumbs_url');
            // if (session()->has('crumbs_url')) {
            //     $crumbs = Session::get('crumbs_url');
            // }
            // $found = array_filter($crumbs, function ($v, $k) use ($url) {
            //     return $v['url'] == $url;
            // }, ARRAY_FILTER_USE_BOTH);


            // if (count($found) > 0) {
            //     $crumbs = array_slice($crumbs, 0, array_keys($found)[0]);
            // }

            $arr_asoc['title'] = request()->segment(2) ?? 'aaaa';
            $arr_asoc['url'] = $url;
            $arr_asoc['name'] = request()->segment(3);
            $arr_asoc['id'] = request()->segment(4);
            array_push($crumbs, $arr_asoc);
        }

        // dd($crumbs);
        // $found = array_filter($crumbs, function ($v, $k) use ($url) {
        //     return $v['url'] == $url;
        // }, ARRAY_FILTER_USE_BOTH);


        // if (count($found) > 0) {
        //     $crumbs = array_slice($crumbs, 0, array_keys($found)[0]);
        // }

        Session::put('crumbs_url', $crumbs);
        // }
        // dd(Session::get('crumbs_url'));



        return $next($request);
    }
}
