<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\Advancedsearch\AdvancedsearchController;
use App\Http\Controllers\Bibliography\BibliographyController;
use App\Http\Controllers\Bibliogrphy\NewBibliographyController;
use App\Http\Controllers\Dictionay\DictionaryController;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\FindData\SearchController;
use App\Http\Controllers\GetTableContentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\Man\ManBeanCountryController;
use App\Http\Controllers\Man\ManController;
use App\Http\Controllers\Man\ManEmailController;
use App\Http\Controllers\Man\ManEventController;
use App\Http\Controllers\Man\ManPhoneController;
use App\Http\Controllers\Man\ManSignalController;
use App\Http\Controllers\Man\ManSignController;
use App\Http\Controllers\ManSignPhotoController;
use App\Http\Controllers\OpenController;
use App\Http\Controllers\OrganizationHasManController;
use App\Http\Controllers\PhoneController;
use App\Http\Controllers\Relation\ModelRelationController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SearchInclude\SimpleSearchController;
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
Route::post('/customAddFileData/{fileName}', [SearchController::class, 'customAddFileData']);


Route::post('/filter/{page}', [FilterController::class, 'filter'])->name('filter');

Route::delete('table-delete/{page}/{id}', [DeleteController::class, 'destroy'])->name('table.destroy');

Route::get('get-file', [FileUploadService::class, 'get_file'])->name('get-file');


Route::group(
    ['prefix' => '{locale}', 'middleware' => 'setLocate'],
    function () {

        Route::group(['middleware' => ['auth']], function () {
            Route::get('translate/index', [TranslateController::class, 'index'])->name('translate.index');
            Route::get('translate/create', [TranslateController::class, 'create'])->name('translate.create');
            Route::post('/bibliography/{bibliography}/file', [BibliographyController::class, 'updateFile'])->name('updateFile');

            Route::resource('bibliography', BibliographyController::class)->only('create', 'edit', 'update');

            Route::get('/get-model-name-in-modal', [ComponentService::class, 'get_section'])->name('open.modal');
            Route::post('/create-table-field', [ComponentService::class, 'storeTableField']);

            Route::get('/model-filter', [ComponentService::class, 'filter'])->name('get-model-filter');
            Route::post('delete', [FileUploadService::class, 'delete'])->name('delete-item');
            Route::post('delete-item', [FileUploadService::class, 'deleteItem'])->name('delete-items');

            Route::get('/showUpload', [SearchController::class, 'showUploadForm'])->name('show.files');
            Route::get('/showAllDetails', [SearchController::class, 'showAllDetails'])->name('show.allDetails');
            Route::post('/upload', [SearchController::class, 'uploadFile'])->name('upload.submit');
            Route::get('/file/{filename}', [SearchController::class, 'file'])->name('file.details');
            Route::get('/reference', [SearchController::class, 'reference'])->name('reference');


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

           // Route::get('simplesearch/result_external_signs', [SimpleSearchController::class, 'result_external_signs']);

            Route::prefix('simplesearch')->group(function () {

                Route::get('/simple_search', [SimpleSearchController::class, 'simple_search'])->name('simple_search');

                Route::get('/simple_search_man', [SimpleSearchController::class, 'simple_search_man'])->name('simple_search_man');
                Route::post('/result_man', [SimpleSearchController::class, 'result_man'])->name('result_man');
                // Route::get('/result_man', [SimpleSearchController::class, 'result_man'])->name('result_man');

                Route::get('/simple_search_address', [SimpleSearchController::class, 'simple_search_address'])->name('simple_search_address');
                Route::post('/result_address', [SimpleSearchController::class, 'result_address'])->name('result_address');
                // Route::get('/result_address', [SimpleSearchController::class, 'result_address'])->name('result_address');

                Route::get('/simple_search_email', [SimpleSearchController::class, 'simple_search_email'])->name('simple_search_email');
                Route::post('/simple_search_email/{type}', [SimpleSearchController::class, 'simple_search_email'])->name('simple_search_email_type');
                Route::get('/simple_search_email/{type}', [SimpleSearchController::class, 'simple_search_email'])->name('simple_search_email_type_get');
                Route::post('/result_email/{type}', [SimpleSearchController::class, 'result_email'])->name('result_email_type');
                Route::post('/result_email', [SimpleSearchController::class, 'result_email'])->name('result_email_post');
                // Route::get('/result_email', [SimpleSearchController::class, 'result_email'])->name('result_email');

                Route::get('/simple_search_external_signs', [SimpleSearchController::class, 'simple_search_external_signs'])->name('simple_search_external_signs');
                Route::post('/result_external_signs', [SimpleSearchController::class, 'result_external_signs'])->name('result_external_signs');
                // Route::get('/result_external_signs', [SimpleSearchController::class, 'result_external_signs'])->name('result_external_signs');

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
                //simple search bibliography
                Route::get('/simple_search_bibliography', [SimpleSearchController::class, 'simple_search_bibliography'])->name('simple_search_bibliography');
                Route::post('/result_bibliography', [SimpleSearchController::class, 'result_bibliography'])->name('result_bibliography');
                //simple search criminal case
                Route::get('/simple_search_criminal_case', [SimpleSearchController::class, 'simple_search_criminal_case'])->name('simple_search_criminal_case');
                Route::post('/result_criminal_case', [SimpleSearchController::class, 'result_criminal_case'])->name('result_criminal_case');
                //simple search event
                Route::get('/simple_search_event', [SimpleSearchController::class, 'simple_search_event'])->name('simple_search_event');
                Route::post('/result_event', [SimpleSearchController::class, 'result_event'])->name('result_event');
                //simple search keep signal
                Route::get('/simple_search_keep_signal', [SimpleSearchController::class, 'simple_search_keep_signal'])->name('simple_search_keep_signal');
                Route::post('/result_keep_signal', [SimpleSearchController::class, 'result_keep_signal'])->name('result_keep_signal');
                //simple search action
                Route::get('/simple_search_action', [SimpleSearchController::class, 'simple_search_action'])->name('simple_search_action');
                Route::post('/result_action', [SimpleSearchController::class, 'result_action'])->name('result_action');
                //simple search man bean country
                Route::get('/simple_search_man_bean_country', [SimpleSearchController::class, 'simple_search_man_bean_country'])->name('simple_search_man_bean_country');
                Route::post('/result_man_bean_country', [SimpleSearchController::class, 'result_man_bean_country'])->name('result_man_bean_country');
                //simple search signal
                Route::get('/simple_search_signal', [SimpleSearchController::class, 'simple_search_signal'])->name('simple_search_signal');
                Route::post('/result_signal', [SimpleSearchController::class, 'result_signal'])->name('result_signal');
                //simple search weapon
                Route::get('/simple_search_weapon', [SimpleSearchController::class, 'simple_search_weapon'])->name('simple_search_weapon');
                Route::post('/result_weapon', [SimpleSearchController::class, 'result_weapon'])->name('result_weapon');
                //simple search work activity
                Route::get('/simple_search_work_activity', [SimpleSearchController::class, 'simple_search_work_activity'])->name('simple_search_work_activity');
                Route::post('/result_work_activity', [SimpleSearchController::class, 'result_work_activity'])->name('result_work_activity');


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

            Route::post('del-model-item', [ManController::class,'deleteFromTable'])->name('del-model-item');

            Route::prefix('man/{man}')->group(function () {

                Route::resource('email', ManEmailController::class)->only('create', 'store');

                Route::resource('phone', ManPhoneController::class)->only('create', 'store', 'edit');

                Route::resource('sign', ManSignController::class,)->only('create', 'store');

                Route::resource('sign-image', ManSignPhotoController::class)->only('create', 'store');

                Route::resource('organization', OrganizationHasManController::class)->only('create', 'store');

                Route::resource('bean-country', ManBeanCountryController::class)->only('create', 'store');

                Route::resource('person-address', AddressController::class)->only('create', 'store');

                Route::resource('signal', ManSignalController::class)->only('create', 'store');

                Route::resource('participant-action', ManEventController::class)->only('create', 'store');

            });

            Route::get('open/{page}', [OpenController::class, 'index'])->name('open.page');
            Route::get('open/{page}/{id}', [OpenController::class, 'restore'])->name('open.page.restore');

            Route::post('get-relations', [ModelRelationController::class,'get_relations'])->name('get_relations');
//Դերեր
            Route::get('/simple-search-test', function () {
                return view('simple_search_test');
            })->name('simple_search_test');


            Route::get('/company', function () {
                return view('company.company');
            })->name('company');

//Անձի բնակության վայրը
        Route::get('/person/address', function () {
            return view('person-address.index');
        })->name('person_address');

// Կապն օբյեկտների միջև
        Route::get('/event', function () {
            return view('event.event');
        })->name('event');

//Գործողություն
        Route::get('/action', function () {
            return view('action.action');
        })->name('action');


// Իրադարձություն
            Route::get('/man-event', function () {
                return view('man-event.man-event');
            })->name('man-event');

//ահազանգ ??
              Route::get('/alarm', function () {
                return view('alarm.alarm');
              })->name('alarm');

//Քրեական գործ
              Route::get('/criminalCase', function () {
                return view('criminalCase.criminalCase');
              })->name('criminalCase');
//Անցնում է ոստիկանության ամփոփագրով
              Route::get('/police', function () {
                return view('police.police');
              })->name('police');
//Ավտոմեքենայի առկայություն
              Route::get('/availability-car', function () {
                return view('availability-car.availability-car');
              })->name('availability-car');
//Զենքի առկայություն
              Route::get('/availability-gun', function () {
                return view('availability-gun.availability-gun');
              })->name('availability-gun');
//Օգտագործվող ավտոմեքենա
              Route::get('/used-car', function () {
                return view('used-car.used-car');
              })->name('used-car');
//Վերահսկում
              Route::get('/control', function () {
                return view('control.control');
              })->name('control');
// Ահազանգի վարում
              Route::get('/alarm-handling', function () {
                return view('alarm-handling.alarm-handling');
              })->name('alarm-handling');

              Route::get('/bibliography/summary-automatic', [SummeryAutomaticController::class, 'index'])->name('bibliography.summery_automatic');

            });

//Հաշվետվություն ըստ ահազանգերի
        Route::get('templatesearch/signal-report', function () {
            return view('template-search.signal-report');
          })->name('templatesearch_signal_report');

        Route::get('/home', [HomeController::class, 'index'])->name('home');
    }


);
