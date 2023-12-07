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
        // dd(Session::get('crumbs_url'));

        // dd(request());
        if (str_contains($uri, '?') || str_contains($currentURL, 'edit') || str_contains($currentURL, 'create')) {
            if (session()->has('crumbs_url')) {
                $crumbs = Session::get('crumbs_url');
            }
        }

        if (request()->segment(3) == 'fusion' && request()->segment(4)) {
            if (session()->has('crumbs_url')) {
                $crumbs = Session::get('crumbs_url');
            }
        }
        if (request()->segment(3) == 'loging' && request()->segment(4)) {
            if (session()->has('crumbs_url')) {
                $crumbs = Session::get('crumbs_url');
            }
        }

        if (request()->segment(2) == 'checked-user-list') {
            if (session()->has('crumbs_url')) {
                $crumbs = Session::get('crumbs_url');
            }
        }
        if (request()->segment(2) == 'advancedsearch') {

            if(request()->segment(3)){
            if (session()->has('crumbs_url')) {
                $crumbs = Session::get('crumbs_url');
            }

            }

        }


        //   dd(request()->segment(3));
        // if(str_contains($currentURL, 'admin')){
        //     $found = array_filter($crumbs, function ($v, $k) use ($url) {
        //         return $v['name'] == request()->segment(3);
        //     }, ARRAY_FILTER_USE_BOTH);

        //     if (session()->has('crumbs_url') && count($found) > 0) {
        //         $crumbs = Session::get('crumbs_url');
        //     }
        //     else{
        //     session()->forget('crumbs_url');

        //     }
        // }
        // if (!str_contains($uri, '?')) {

        //     if (request()->segment(2) == 'open') {
        //         $url_page = explode("open/", $url)[1];

        //         if (str_contains(url()->previous(), $url_page)) {

        if (str_contains($uri, '?')) {
            $url = explode("/$language", $uri)[1];
        }

        if (str_contains($currentURL, 'loging') && str_contains($uri, '?')) {
            $found = array_filter($crumbs, function ($v, $k) use ($url) {
                return $v['name'] == request()->segment(3);
            }, ARRAY_FILTER_USE_BOTH);
        } else {
            $found = array_filter($crumbs, function ($v, $k) use ($url) {
                return $v['url'] == $url;
            }, ARRAY_FILTER_USE_BOTH);
        }


        if (count($found) > 0) {

            $crumbs = array_slice($crumbs, 0, array_keys($found)[0]);
        }
        //     }
        //     }
        // }

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
        }
        // else if (request()->segment(2) == 'bibliography') {
        //     session()->forget('crumbs_url');

        //     // $arr_asoc['title'] = 'dictionary';
        //     // $arr_asoc['url'] = $url;
        //     // $arr_asoc['name'] = request()->segment(3);
        //     // $crumbs[0] = $arr_asoc;
        //     // $crumbs = array_slice($crumbs, 0, 1);
        // }
        else {

            if (!str_contains($currentURL, 'edit') && !str_contains($currentURL, 'create')) {
                $arr_asoc['title'] = request()->segment(2);
                $arr_asoc['url'] = $url;
                $arr_asoc['name'] = request()->segment(3);


                if (request()->segment(3) == 'fusion' && request()->segment(4)) {

                    $arr_asoc['name'] = request()->segment(4);
                }

                if (request()->segment(3) == 'loging' && request()->segment(4)) {
                    $arr_asoc['url'] = $url;

                    $arr_asoc['name'] = request()->segment(4);
                    $arr_asoc['id'] = request()->segment(5);
                }
                if (request()->segment(2) == 'table-content') {
                    if (!str_contains($uri, '?')) {
                        $arr_asoc['name'] = 'search_table_content';
                        $arr_asoc['title'] = 'search_table_content';
                    } else {
                        $arr_asoc['name'] = 'data-entry-through-files';
                        $arr_asoc['title'] = 'data-entry-through-files';
                    }
                }
                if (request()->segment(2) == 'checked-user-list') {
                    $arr_asoc['name'] = 'checked-user-list';
                }
                if (request()->segment(2) == 'search-file' || request()->segment(2) == 'search-file-result') {
                    $arr_asoc['name'] = 'search_file';
                    $arr_asoc['title'] = 'search_file';
                }
                if (request()->segment(2) == 'advancedsearch') {

                    $arr_asoc['name'] = 'advancedsearch';
                    if (request()->segment(3)) {
                        $arr_asoc['name'] = request()->segment(3);
                        // if (session()->has('crumbs_url')) {
                        //     $crumbs = Session::get('crumbs_url');
                        // }

                        // array_pop($crumbs);
                    }
                    if(str_contains(request()->segment(3), 'result')){
                        array_pop($crumbs);

                        }
                }
                if (request()->segment(2) == 'simplesearch' && str_contains(request()->segment(3), 'result')) {

                    if (session()->has('crumbs_url')) {
                        $crumbs = Session::get('crumbs_url');
                    }
                    array_pop($crumbs);
                }



                array_push($crumbs, $arr_asoc);
                // dd($crumbs);
            }
        }
        if (str_contains($currentURL, 'create') && request()->segment(2) !== 'man' && request()->segment(2) !== 'organization') {
            $arr_asoc['title'] = request()->segment(2) ?? '';
            $arr_asoc['url'] = $url;
            // $arr_asoc['name'] = request()->segment(3);
            $arr_asoc['name'] = 'create';
            array_push($crumbs, $arr_asoc);
        }
        if (request()->segment(2) == 'bibliography') {
            $crumbs = [];
            $arr_asoc['name'] = 'bibliography';

            session()->forget('crumbs_url');
        }
        if (request()->segment(2) == 'translate') {
            // $crumbs = [];
            // $arr_asoc['url'] = $url;
            // $arr_asoc['name'] = 'translate';
            // session()->forget('crumbs_url');

            // array_push($crumbs, $arr_asoc);

        }


        if (str_contains($currentURL, 'edit')) {

            if (str_contains(url()->previous(), '?') || str_contains(url()->previous(), 'bibliography')) {

                array_pop($crumbs);
            }


            $arr_asoc['title'] = request()->segment(2) ?? '';
            $arr_asoc['url'] = $url;
            $arr_asoc['name'] = request()->segment(3);
            // $arr_asoc['name'] = 'edit';

            $arr_asoc['id'] = request()->segment(4);
            if (request()->segment(4) == 'edit') {
                $arr_asoc['name'] = request()->segment(2);
                $arr_asoc['id'] = request()->segment(3);
            }

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
