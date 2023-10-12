<?php



use App\Http\Controllers\Advancedsearch\AdvancedsearchController;

use App\Http\Controllers\FileController;


use App\Http\Controllers\EmailController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\GetTableContentController;
use App\Http\Controllers\ManBeanCountryController;
use App\Http\Controllers\ManController;
use App\Http\Controllers\OrganizationHasManController;
use App\Http\Controllers\PhoneController;
use App\Http\Controllers\SignController;
use App\Http\Controllers\SignPhotoController;
use App\Http\Controllers\TranslateController;
use App\Services\Form\FormContentService;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\FindData\SearchController;
use App\Http\Controllers\SearchInclude\SimpleSearchController;

use App\Services\FileUploadService;

use App\Http\Controllers\Bibliography\BibliographyController;
use App\Http\Controllers\Dictionay\DictionaryController;
use App\Http\Controllers\FilterController;

use App\Http\Controllers\TableDelete\DeleteController;

use App\Services\BibliographyFilterService;

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


Route::post('/filter/{page}', [FilterController::class, 'filter'])->name('filter');

Route::delete('table-delete/{page}/{id}', [DeleteController::class, 'destroy'])->name('table.destroy');

Route::get('get-file', [FileUploadService::class, 'get_file'])->name('get-file');


Route::group(
    ['prefix' => '{locale}', 'middleware' => 'setLocate'],
    function () {

        Route::group(['middleware' => ['auth']], function () {


            Route::get('/bibliography', [BibliographyController::class, 'create'])->name('bibliography.create');
            Route::post('/get-bibliography-section-from-modal', [BibliographyController::class, 'get_section']);
            Route::post('bibliography-filter',[BibliographyFilterService::class,'filter'])->name('get-bibliography-filter');
            Route::post('/bibliography-update/{id}', [BibliographyController::class, 'update']);

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


            Route::get('/checked-file-data/{filename}', [SearchController::class, 'index'])->name('checked-file-data.file_data');


            Route::resource('roles', RoleController::class);

            Route::resource('users', UserController::class);
            Route::resource('roles', RoleController::class);
            Route::get('users/chane-status', [UserController::class, 'change_status'])->name('user.change_status');
            Route::resource('table-content', GetTableContentController::class);


            // ====================================================================
            // ====================================================================
            Route::prefix('advancedsearch')->group(function () {

                Route::get('/', [AdvancedsearchController::class, 'index'])->name('advancedsearch');
                Route::get('/bibliography', [AdvancedsearchController::class, 'bibliography'])->name('bibliography');
                Route::get('/email', [AdvancedsearchController::class, 'email'])->name('email');
                Route::post('/result_email', [AdvancedsearchController::class, 'result_email'])->name('advancedsearch_email');
                Route::get('/result_email', [AdvancedsearchController::class, 'result_email'])->name('advancedsearch_result_email');

            });
            // Route::get('simplesearch/simple_search_bibliography/1', [AdvancedsearchController::class, 'simple_search_bibliography'])->name('simple_search_bibliography');

            // Route::get('simplesearch/simple_search', [AdvancedsearchController::class, 'simple_search'])->name('simple_search');
            // Route::get('simplesearch/simple_search_external_signs', [AdvancedsearchController::class, 'simple_search_external_signs'])->name('simple_search_external_signs');


            // Route::post('simplesearch/result_external_signs', [SimpleSearchController::class, 'result_external_signs'])->name('result_external_signs');
            // Route::get('simplesearch/result_external_signs', [SimpleSearchController::class, 'result_external_signs']);

            Route::prefix('simplesearch')->group(function () {

                Route::get('/simple_search_man', [SimpleSearchController::class, 'simple_search_man'])->name('simple_search_man');
                Route::post('/result_man', [SimpleSearchController::class, 'result_man'])->name('result_address_post');

                Route::get('/simple_search_address', [SimpleSearchController::class, 'simple_search_address'])->name('simple_search_address');
                Route::post('/result_address', [SimpleSearchController::class, 'result_address'])->name('result_address_post');

                Route::get('/simple_search_email', [SimpleSearchController::class, 'simple_search_email'])->name('simple_search_email');
                Route::post('/simple_search_email/{type}', [SimpleSearchController::class, 'simple_search_email'])->name('simple_search_email_type');
                Route::get('/simple_search_email/{type}', [SimpleSearchController::class, 'simple_search_email'])->name('simple_search_email_type_get');
                Route::post('/result_email/{type}', [SimpleSearchController::class, 'result_email'])->name('result_email_type');
                Route::post('/result_email', [SimpleSearchController::class, 'result_email'])->name('result_email_post');
                Route::get('/result_email', [SimpleSearchController::class, 'result_email'])->name('result_email');
                //simple search car
                Route::get('/simple_search_car', [SimpleSearchController::class, 'simple_search_car'])->name('simple_search_car');
                Route::post('/result_car', [SimpleSearchController::class, 'result_car'])->name('result_car');
                //simple search organization
                Route::get('/simple_search_organization', [SimpleSearchController::class, 'simple_search_organization'])->name('simple_search_organization');
                Route::post('/result_organization', [SimpleSearchController::class, 'result_organization'])->name('result_organization');
                //simple search control
                Route::get('/simple_search_control', [SimpleSearchController::class, 'simple_search_control'])->name('simple_search_control');
                Route::post('/result_control', [SimpleSearchController::class, 'result_control'])->name('result_control');
                //simple search phone
                Route::get('/simple_search_phone', [SimpleSearchController::class, 'simple_search_phone'])->name('simple_search_phone');
                Route::post('/result_phone', [SimpleSearchController::class, 'result_phone'])->name('result_phone');
                //simple search mia summary
                Route::get('/simple_search_mia_summary', [SimpleSearchController::class, 'simple_search_mia_summary'])->name('simple_search_mia_summary');
                Route::post('/result_mia_summary', [SimpleSearchController::class, 'result_mia_summary'])->name('result_mia_summary');
                 //simple search objects relation
                 Route::get('/simple_search_objects_relation', [SimpleSearchController::class, 'simple_search_objects_relation'])->name('simple_search_objects_relation');
                 Route::post('/result_objects_relation', [SimpleSearchController::class, 'result_objects_relation'])->name('result_objects_relation');


            });
             // ====================================================================
            // ====================================================================


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
                Route::resource('email', EmailController::class)->only('create', 'store');

                Route::resource('phone', PhoneController::class)->only('create', 'store', 'edit');

                Route::resource('sign', SignController::class,)->only('create', 'store');

                Route::resource('sign-image', SignPhotoController::class)->only('create', 'store');

                Route::resource('organization', OrganizationHasManController::class)->only('create', 'store');

                Route::resource('bean-country', ManBeanCountryController::class)->only('create', 'store');
            });

            // test bararan

            // Route::get('/test-test', function () {
            //     return view('test_test');
            // })->name('testtest');

            // end test

            Route::get('/simple-search-test', function () {
                return view('simple_search_test');
            })->name('simple_search_test');


        });

        Route::get('/home', [HomeController::class, 'index'])->name('home');

    }
);
