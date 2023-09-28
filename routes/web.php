<?php

use App\Http\Controllers\FileController;
use App\Http\Controllers\GetTableContentController;
use App\Http\Controllers\TranslateController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\FindData\SearchController;

use App\Services\FileUploadService;

use App\Http\Controllers\Bibliography\BibliographyController;
use App\Http\Controllers\FilterController;



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

Route::get('translate/index', [TranslateController::class, 'index'])->name('translate.index');
Route::post('translate', [TranslateController::class, 'translate'])->name('translate');
Route::post('system-learning', [TranslateController::class, 'system_learning'])->name('system_learning');

// this line is for indexing the initial files
// Route::get('indexingFiles', [FileController::class, 'indexingExistingFiles']);

Auth::routes();
Route::redirect('/', '/' . app()->getLocale() . '/home');

Route::get('change-language/{locale}', [LanguageController::class, 'changeLanguage']);
Route::delete('/uploadDetails/{row}', [SearchController::class, 'destroyDetails'])->name('details.destroy');
Route::patch('/editDetailItem/{id}', [SearchController::class, 'editDetailItem']);
Route::post('/filter', [FilterController::class, 'filter'])->name('filter');

Route::group(
    ['prefix' => '{locale}', 'middleware' => 'setLocate'],
    function () {
        Route::group(['middleware' => ['auth']], function () {
            Route::get('/bibliography', [BibliographyController::class, 'create'])->name('bibliography.create');
            Route::get('/showUpload', [SearchController::class, 'showUploadForm'])->name('show.files');
            Route::get('/showAllDetails', [SearchController::class, 'showAllDetails'])->name('show.allDetails');
            Route::post('/upload', [SearchController::class, 'uploadFile'])->name('upload.submit');
            Route::get('/file/{filename}', [SearchController::class, 'file'])->name('file.details');
            Route::get('/showAllDetailsDoc/{filename}', [SearchController::class, 'showAllDetailsDoc'])->name('show.all.file');
            // Route::get('/details/{editId}', [SearchController::class, 'editDetails'])->name('edit.details');
            // Route::patch('/details/{updatedId}', [SearchController::class, 'updateDetails'])->name('update.details');
            Route::get('/file-details', [SearchController::class, 'seeFileText'])->name('fileShow');
            Route::get('/checked-file-data/{filename}', [SearchController::class, 'checkedFileData'])->name('checked-file-data.file_data');
            Route::resource('roles', RoleController::class);
            Route::resource('users', UserController::class);
            Route::get('users/chane-status', [UserController::class, 'change_status'])->name('user.change_status');
            Route::resource('table-content', GetTableContentController::class);

            // test bararan

            Route::get('/test-test', function () {
                return view('test_test');
            })->name('testtest');

            // end test

            Route::get('/simple-search-test', function () {
              return view('simple_search_test');
            })->name('simple_search_test');


        });
        Route::get('/home', [HomeController::class, 'index'])->name('home');
    }
);
Route::get('get-file', [FileUploadService::class, 'get_file'])->name('get-file');
