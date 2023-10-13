<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\Bibliography\BibliographyController;
use App\Http\Controllers\Bibliogrphy\NewBibliographyController;
use App\Http\Controllers\Dictionay\DictionaryController;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\FindData\SearchController;
use App\Http\Controllers\GetTableContentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\OpenController;
use App\Http\Controllers\Man\ManBeanCountryController;
use App\Http\Controllers\Man\ManController;
use App\Http\Controllers\Man\ManEmailController;
use App\Http\Controllers\Man\ManEventController;
use App\Http\Controllers\Man\ManPhoneController;
use App\Http\Controllers\Man\ManSignalController;
use App\Http\Controllers\OrganizationHasManController;
use App\Http\Controllers\PhoneController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SignController;
use App\Http\Controllers\SignPhotoController;
use App\Http\Controllers\Summery\SummeryAutomaticController;
use App\Http\Controllers\TableDelete\DeleteController;
use App\Http\Controllers\TranslateController;
use App\Http\Controllers\UserController;
use App\Services\ComponentService;
use App\Services\FileUploadService;
use Illuminate\Support\Facades\Route;


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

Route::post('translate', [TranslateController::class, 'translate'])->name('translate');
Route::post('system-learning', [TranslateController::class, 'system_learning'])->name('system_learning');

// this line is for indexing the initial files
// Route::get('indexingFiles', [FileController::class, 'indexingExistingFiles']);

Auth::routes();
Route::redirect('/', '/' . app()->getLocale() . '/home');

Route::get('change-language/{locale}', [LanguageController::class, 'changeLanguage']);
Route::delete('/uploadDetails/{row}', [SearchController::class, 'destroyDetails'])->name('details.destroy');

Route::patch('/editFileDetailItem/{id}', [SearchController::class, 'editDetailItem']);
Route::post('/likeFileDetailItem', [SearchController::class, 'likeFileDetailItem']);
Route::post('/newFileDataItem', [SearchController::class, 'newFileDataItem']);
Route::post('/bringBackLikedData', [SearchController::class, 'bringBackLikedData']);


Route::post('/filter/{page}', [FilterController::class, 'filter'])->name('filter');

Route::delete('table-delete/{page}/{id}', [DeleteController::class, 'destroy'])->name('table.destroy');

Route::get('get-file', [FileUploadService::class, 'get_file'])->name('get-file');


Route::group(
    ['prefix' => '{locale}', 'middleware' => 'setLocate'],
    function () {
        Route::group(['middleware' => ['auth']], function () {

            Route::post('/bibliography/{bibliography}/file', [BibliographyController::class, 'updateFile'])->name('updateFile');

            Route::resource('/bibliography', BibliographyController::class)->only('create', 'edit', 'update');

            Route::get('/get-model-name-in-modal', [ComponentService::class, 'get_section'])->name('open.modal');
            Route::post('/create-table-field', [ComponentService::class, 'storeTableField']);

            Route::get('/model-filter', [ComponentService::class, 'filter'])->name('get-model-filter');
            Route::post('delete', [FileUploadService::class, 'delete'])->name('delete-item');
            Route::post('delete-item', [FileUploadService::class, 'deleteItem'])->name('delete-items');




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


            Route::get('/checked-file-data/{filename}', [SearchController::class, 'index'])->name(
                'checked-file-data.file_data'
            );


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

            Route::prefix('man/{man}')->group(function () {
                Route::resource('email', ManEmailController::class)->only('create', 'store');

                Route::resource('phone', ManPhoneController::class)->only('create', 'store', 'edit');

                Route::resource('sign', SignController::class,)->only('create', 'store');

                Route::resource('sign-image', SignPhotoController::class)->only('create', 'store');

                Route::resource('organization', OrganizationHasManController::class)->only('create', 'store');

                Route::resource('bean-country', ManBeanCountryController::class)->only('create', 'store');

                Route::resource('person-address', AddressController::class)->only('create', 'store');

                Route::resource('signal', ManSignalController::class)->only('create', 'store');

                Route::resource('participant-action', ManEventController::class)->only('create', 'store');
            });

            Route::get('open/{page}', [OpenController::class, 'index'])->name('open.page');

            Route::get('/simple-search-test', function () {
                return view('simple_search_test');
            })->name('simple_search_test');


            Route::get('/company', function () {
                return view('company.company');
            })->name('company');


        Route::get('/person/address', function () {
            return view('test-person-address.index');
        })->name('person_address');

        Route::get('/event', function () {
            return view('event.event');
        })->name('event');

        Route::get('/person/address', function () {
            return view('test-person-address.index');
        })->name('person_address');

        Route::get('/event', function () {
            return view('event.event');
        })->name('event');

        Route::get('/action', function () {
            return view('action.action');
        })->name('action');

              Route::get('/action', function () {

                return view('action.action');
            })->name('action');

            Route::get('/man-event', function () {
                return view('man-event.man-event');
            })->name('man-event');


              Route::get('/alarm', function () {
                return view('alarm.alarm');
              })->name('alarm');

              Route::get('/criminalCase', function () {
                return view('criminalCase.criminalCase');
              })->name('criminalCase');

              Route::get('/bibliography/summary-automatic', [SummeryAutomaticController::class, 'index'])->name('bibliography.summery_automatic');

            });


        Route::get('/home', [HomeController::class, 'index'])->name('home');
    }
);
