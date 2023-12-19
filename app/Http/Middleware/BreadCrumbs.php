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

        if (request()->segment(2) == 'open') {



            $arr_asoc['title'] = 'open';
            $arr_asoc['url'] = $url;
            $arr_asoc['name'] = request()->segment(3);

            array_push($crumbs, $arr_asoc);


        } else if (request()->segment(2) == 'dictionary') {
            session()->forget('crumbs_url');

            $arr_asoc['title'] = 'dictionary';
            $arr_asoc['url'] = $url;
            $arr_asoc['name'] = request()->segment(3);
            $crumbs[0] = $arr_asoc;

        }

        else {

            if (!str_contains($currentURL, 'edit') && !str_contains($currentURL, 'create') ) {
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
                if (request()->segment(2) == 'table-content' || str_contains($uri, 'summary-automatic') || (request()->segment(2) == 'reference')) {
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
                if (request()->segment(2) == 'action') {
                    $arr_asoc['name'] = 'bibliography';
                    $arr_asoc['url'] = "/bibliography/".request()->segment(3)."/edit";
                    $arr_asoc['id'] = request()->segment(3);

                }
                // if(request()->segment(3) == 'summary-automatic'){

                // }
                if (request()->segment(2) == 'advancedsearch') {

                    $arr_asoc['name'] = 'advancedsearch';
                    if (request()->segment(3)) {
                        $arr_asoc['name'] = request()->segment(3);

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

                if (request()->segment(2) == 'translate') {
                    $arr_asoc['name'] = 'translate';
                }


                array_push($crumbs, $arr_asoc);

            }
        }
        if (str_contains($currentURL, 'create') && request()->segment(2) !== 'man' && request()->segment(2) !== 'organization'
        && request()->segment(2) !== 'signal' && request()->segment(2) !== 'event' && request()->segment(2) !== 'criminal_case'
        && request()->segment(2) !== 'controll' && request()->segment(2) !== 'mia_summary' && request()->segment(2) !== 'action') {
            if(str_contains(url()->previous(), 'redirect')){

                array_pop($crumbs);

            }

            if(request()->segment(2) == 'work-activity' && str_contains($uri, 'organization')){

                array_pop($crumbs);
                array_pop($crumbs);
            }

            // dd($crumbs);


            $arr_asoc['title'] = request()->segment(2) ?? '';
            $arr_asoc['url'] = $url;

            $arr_asoc['name'] = 'create';
            array_push($crumbs, $arr_asoc);


        }


        if (str_contains($currentURL, 'edit')) {
            // dd($crumbs);

            if (str_contains(url()->previous(), '?') && !str_contains(url()->previous(), 'organization')) {


                array_pop($crumbs);
            }
            // if(request()->segment(2) == 'action' ){

            //     array_pop($crumbs);
            //     array_pop($crumbs);
            // }

            $arr_asoc['title'] = request()->segment(2) ?? '';
            $arr_asoc['url'] = $url;
            $arr_asoc['name'] = request()->segment(3);


            $arr_asoc['id'] = request()->segment(4);


            if (request()->segment(4) == 'edit') {

                $arr_asoc['name'] = request()->segment(2);
                $arr_asoc['id'] = request()->segment(3);

                if (request()->segment(2) == 'bibliography') {

                    if(str_contains(url()->previous(), 'open')){

                        $arr_asoc['title'] = 'bibliography';
                    }
                    else{
                        $arr_asoc['title'] = 'addTo';
                        $crumbs = [];

                    }

                }

            }

            array_push($crumbs, $arr_asoc);
        }

        Session::put('crumbs_url', $crumbs);




        return $next($request);
    }
}
