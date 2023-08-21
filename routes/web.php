<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LanguageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::redirect('/', '/' . app()->getLocale() . '/home');

Route::get('change-language/{locale}', [LanguageController::class, 'changeLanguage']);
Route::group(
    [
        'prefix' =>  '{locale}',
        'where' => ['locale' => '[a-zA-Z]{2}'],
        'middleware' => 'setLocate'
    ],
    function () {
        Route::group(['middleware' => ['auth']], function () {
            Route::resource('roles', RoleController::class);
            Route::resource('users', UserController::class);
        });
        Route::get('/home', [HomeController::class, 'index'])->name('home');
    }
);
