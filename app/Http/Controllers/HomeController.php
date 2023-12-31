<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        // $lang = config('app.locale');

        // if(session()->has('locale')){
        //     $lang = session()->get('locale');
        // }

        // App::setLocale($lang);
        // dd( $request->getHost());
        return view('home');

    }

    public function redirectFirstRequest()
    {
        if (Auth::user()->roles->count() == 1 && Auth::user()->hasRole('forsearch')) {
            return redirect('/' . app()->getLocale() . '/searche');
        }else {
            return redirect('/' . app()->getLocale() . '/home');
        }
    }
}
