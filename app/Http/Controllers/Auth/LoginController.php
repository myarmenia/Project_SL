<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Services\Log\LogService;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    public function username()
    {
        return 'username';
    }

    protected function authenticated(Request $request, $user)
    {

        $type = 'login';
        $id = $user->id;

        if(!$user->status){

            $type = 'login_blocked';
            $this->guard()->logout();
        }

        LogService::store(null, $id, 'users', $type);


    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function logout(Request $request)
    {


        $user = Auth::user();
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        LogService::store(null, $user->id, 'users', 'logout');


        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect('/');
    }
}
