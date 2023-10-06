<?php

use App\Http\Controllers\Bibliography\BibliographyController;
use App\Http\Controllers\Dictionay\DictionaryController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\FilterController;

use App\Http\Controllers\FindData\SearchController;
use App\Http\Controllers\GetTableContentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\ManController;
use App\Http\Controllers\PhoneController;
use App\Http\Controllers\RoleController;

use App\Http\Controllers\FormController;

use App\Http\Controllers\TableDelete\DeleteController;
use App\Http\Controllers\TranslateController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WorkerController;
use App\Services\BibliographyFilterService;

use App\Services\FileUploadService;
use Illuminate\Support\Facades\Route;

use App\Services\Form\FormContentService;


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
Route::redirect('/', '/'.app()->getLocale().'/home');

Route::get('change-language/{locale}', [LanguageController::class, 'changeLanguage']);
Route::delete('/uploadDetails/{row}', [SearchController::class, 'destroyDetails'])->name('details.destroy');

Route::patch('/editFileDetailItem/{id}', [SearchController::class, 'editDetailItem']);
Route::post('/likeFileDetailItem', [SearchController::class, 'likeFileDetailItem']);
Route::post('/newFileDataItem', [SearchController::class, 'newFileDataItem']);


Route::post('/filter', [FilterController::class, 'filter'])->name('filter');
Route::delete('table-delete/{page}/{id}', [DeleteController::class, 'destroy'])->name('table.destroy');


Route::group(
    ['prefix' => '{locale}', 'middleware' => 'setLocate'],
    function () {
        Route::group(['middleware' => ['auth']], function () {


            Route::get('/bibliography', [BibliographyController::class, 'index'])->name('bibliography.index');
            // Route::post('/get-bibliography-section-from-modal', [BibliographyController::class, 'get_section']);
            // Route::post('bibliography-filter',[BibliographyFilterService::class,'filter'])->name('get-bibliography-filter');
            // Route::post('/bibliography-update/{id}', [BibliographyController::class, 'update']);
            Route::get('/bibliography/{id}', [BibliographyController::class, 'show'])->name('bibliography.show');

            // Route::get('/form',[FormController::class,'index'])->name('form.index');
            Route::post('/get-model-name-in-modal',[FormController::class,'get_section'])->name('open.modal');
            Route::post('model-filter',[FormContentService::class,'filter'])->name('get-model-filter');
            Route::post('/model-update', [FormController::class, 'update']);
            Route::post('/model-store', [FormController::class, 'store']);
            // Route::get('/form/{id}',[FormController::class,'show'])->name('form.show');
            //=====



            Route::get('/showUpload', [SearchController::class, 'showUploadForm'])->name('show.files');
            Route::get('/showAllDetails', [SearchController::class, 'showAllDetails'])->name('show.allDetails');
            Route::post('/upload', [SearchController::class, 'uploadFile'])->name('upload.submit');
            Route::get('/file/{filename}', [SearchController::class, 'file'])->name('file.details');

            Route::get('/showAllDetailsDoc/{filename}', [SearchController::class, 'showAllDetailsDoc'])->name(
                'show.all.file'
            );

            Route::get('/show-file/{filename}', [SearchController::class, 'showFile'])->name('file.show-file');
            // Route::get('/showAllDetailsDoc/{filename}', [SearchController::class, 'showAllDetailsDoc'])->name('show.all.file');

            // Route::get('/details/{editId}', [SearchController::class, 'editDetails'])->name('edit.details');
            // Route::patch('/details/{updatedId}', [SearchController::class, 'updateDetails'])->name('update.details');
            Route::get('/file-details', [SearchController::class, 'seeFileText'])->name('fileShow');



            Route::get('/checked-file-data/{filename}', [SearchController::class, 'checkedFileData'])->name(
                'checked-file-data.file_data'
            );

            Route::get('/checked-file-data/{filename}', [SearchController::class, 'index'])->name('checked-file-data.file_data');

            Route::resource('roles', RoleController::class);

            Route::resource('users', UserController::class);
            Route::resource('roles', RoleController::class);
            Route::get('users/chane-status', [UserController::class, 'change_status'])->name('user.change_status');
            Route::resource('table-content', GetTableContentController::class);

            Route::get('dictionary/{page}', [DictionaryController::class, 'index'])->name('dictionary.pages');
            Route::post('dictionary/{page}/store', [DictionaryController::class, 'store'])->name('dictionary.store');
            Route::patch('dictionary/{page}/update/{id}', [DictionaryController::class, 'update'])->name(
                'dictionary.update'
            );

            // Route::group('dictionary', function () {
            //     Route::get('/agency', [UserController::class, 'change_status'])->name('user.change_status');
            // });


            Route::resource('man', ManController::class)->only('edit', 'create', 'update');
            Route::get('email/{man}', [EmailController::class, 'create'])->name('email.create');
            Route::post('email/{man}', [EmailController::class, 'store'])->name('email.store');

            Route::get('phone/{man}', [PhoneController::class, 'create'])->name('phone.create');
            Route::post('phone/{man}', [PhoneController::class, 'store'])->name('phone.store');
            Route::get('worker/{man}', [WorkerController::class, 'create'])->name('worker.create');
            Route::get('/being-country', function () {
                return view('being-country.being-country');
            })->name('being-country');

            // test bararan

            // Route::get('/test-test', function () {
            //     return view('test_test');
            // })->name('testtest');

            // end test

            Route::get('/simple-search-test', function () {
                return view('simple_search_test');
            })->name('simple_search_test');


            Route::get('/external-signs', function () {
                return view('external-signs.external-signs');
            })->name('external-signs');

            Route::get('/external-signs-image', function () {
                return view('external-signs-image.external-signs-image');

              })->name('external-signs-image');

              Route::get('/company', function () {
                return view('company.company');
              })->name('company');

        });
        Route::get('/home', [HomeController::class, 'index'])->name('home');
    }
);
Route::get('get-file', [FileUploadService::class, 'get_file'])->name('get-file');


