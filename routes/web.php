<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\Advancedsearch\AdvancedsearchController;
use App\Http\Controllers\AlarmCheckObjectController;
use App\Http\Controllers\Bibliography\BibliographyController;
use App\Http\Controllers\Bibliogrphy\NewBibliographyController;
use App\Http\Controllers\Controll\ControllController;
use App\Http\Controllers\CriminalCase\CriminalCaseController;
// use App\Http\Controllers\CriminalCaseController;
use App\Http\Controllers\Dictionay\DictionaryController;
use App\Http\Controllers\Event\EventController;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\FindData\SearchController;
use App\Http\Controllers\GetTableContentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\LogingController;
use App\Http\Controllers\Man\ManActionParticipant;
use App\Http\Controllers\Man\ManBeanCountryController;
use App\Http\Controllers\Man\ManController;
use App\Http\Controllers\Man\ManEmailController;
use App\Http\Controllers\Man\ManEventController;
use App\Http\Controllers\Man\ManOperationalInterest;
use App\Http\Controllers\Man\ManOperationalInterestOrganization;
use App\Http\Controllers\Man\ManPhoneController;
use App\Http\Controllers\Man\ManSignalController;
use App\Http\Controllers\Man\ManSignController;
use App\Http\Controllers\Man\ManSignPhotoController;
use App\Http\Controllers\OpenController;
use App\Http\Controllers\OrganizationHasManController;
use App\Http\Controllers\PoliceSearchController;
use App\Http\Controllers\Relation\ModelRelationController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SearchInclude\SimpleSearchController;
use App\Http\Controllers\Signal\KeepSignalController;
use App\Http\Controllers\Signal\SignalController;
use App\Http\Controllers\Summery\SummeryAutomaticController;
use App\Http\Controllers\TableDelete\DeleteController;
use App\Http\Controllers\TranslateController;
use App\Http\Controllers\UserController;
use App\Services\ComponentService;
use App\Services\FileUploadService;
use App\Services\Relation\AddRelationService;
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
Route::post('system-learning/filter', [TranslateController::class, 'filter']);

// this line is for indexing the initial files
// Route::get('indexingFiles', [FileController::class, 'indexingExistingFiles']);

Auth::routes();
Route::get('/', [HomeController::class, 'redirectFirstRequest'])->name('home');
// Route::redirect('/', '/' . app()->getLocale() . '/home');

Route::get('change-language/{locale}', [LanguageController::class, 'changeLanguage']);
Route::delete('/uploadDetails/{row}', [SearchController::class, 'destroyDetails'])->name('details.destroy');

Route::patch('/editFileDetailItem/{id}', [SearchController::class, 'editDetailItem']);
Route::post('/likeFileDetailItem', [SearchController::class, 'likeFileDetailItem']);
Route::post('/newFileDataItem', [SearchController::class, 'newFileDataItem']);
Route::post('/bringBackLikedData', [SearchController::class, 'bringBackLikedData']);
Route::post('/customAddFileData/{fileName}', [SearchController::class, 'customAddFileData'])->middleware(['replaceEmptyStringToNull']);


Route::post('/filter/{page}', [FilterController::class, 'filter'])->name('filter');

Route::delete('table-delete/{page}/{id}', [DeleteController::class, 'destroy'])->name('table.destroy');

Route::get('get-file', [FileUploadService::class, 'get_file'])->name('get-file');


Route::group(
    ['prefix' => '{locale}', 'middleware' => 'setLocate'],
    function () {

        Route::group(['middleware' => ['auth', 'checkRoleSearch']], function (){
          Route::post('/police-search', [PoliceSearchController::class, 'searchPolice'])->name('police-search');

          Route::get('/searche', function () {
            return view('searche.searche');
          })->name('searche');
        });

        Route::group(['middleware' => ['auth', 'rolesNotEqualForSearch']], function () {
            Route::get('translate/index', [TranslateController::class, 'index'])->name('translate.index');
            Route::get('translate/create', [TranslateController::class, 'create'])->name('translate.create');
            //=========== bibliography section start===========
            Route::post('/bibliography/{bibliography}/file', [BibliographyController::class, 'updateFile'])->name('updateFile');
            Route::post('/bibliography-man-paragraph', [BibliographyController::class, 'getManParagraph'])->name('get-man-paragraph');
            Route::resource('bibliography', BibliographyController::class)->only('create', 'edit', 'update');

            Route::get('/get-model-name-in-modal', [ComponentService::class, 'get_section'])->name('open.modal');
            Route::post('/create-table-field', [ComponentService::class, 'storeTableField']);

            Route::get('/model-filter', [ComponentService::class, 'filter'])->name('get-model-filter');

            Route::post('delete-teg', [BibliographyController::class, 'deleteteTeg'])->name('delete-item');
            Route::post('delete-item', [FileUploadService::class, 'deleteItem'])->name('delete-items');

            Route::get('/showUpload', [SearchController::class, 'showUploadForm'])->name('show.files');
            Route::get('/showAllDetails', [SearchController::class, 'showAllDetails'])->name('show.allDetails');
            Route::post('/upload', [SearchController::class, 'uploadFile'])->name('upload.submit');
            Route::post('/uploadReference', [SearchController::class, 'uploadReference'])->name('upload.reference');
            Route::get('/file/{filename}', [SearchController::class, 'file'])->name('file.details');
            Route::get('/reference', [SearchController::class, 'reference'])->name('reference');
            Route::post('/searchFilter/{fileName}', [SearchController::class, 'searchFilter'])->name('search.filter');


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
            Route::post('users/change-status/{id}/{status}', [UserController::class, 'change_status'])->name('user.change_status');

            Route::resource('table-content', GetTableContentController::class);
            // =================== signal section start ======================
            Route::resource('signal',SignalController::class)->only('create','edit','update');
            Route::resource('keepSignal',KeepSignalController::class)->only('create','edit','update');
            Route::resource('controll',ControllController::class)->only('create','edit','update');


            // ====================================================================
            // ====================================================================
            Route::prefix('advancedsearch')->group(function () {

                Route::get('/', [AdvancedsearchController::class, 'index'])->name('advancedsearch');

                //advanced_search_bibliography
                Route::get('/bibliography', [AdvancedsearchController::class, 'bibliography'])->name('advanced_bibliography');
                Route::match(['get','post'],'/result_bibliography', [AdvancedsearchController::class, 'result_bibliography'])->name('advanced_result_bibliography');

                Route::get('/email', [AdvancedsearchController::class, 'email'])->name('email');
                Route::match(['get','post'],'/result_email', [AdvancedsearchController::class, 'result_email'])->name('advancedsearch_email');
                //advanced_search_keep_signal
                Route::get('/keep_signal', [AdvancedsearchController::class, 'keep_signal'])->name('advanced_keep_signal');
                Route::match(['get','post'],'/result_keep_signal', [AdvancedsearchController::class, 'result_keep_signal'])->name('advanced_result_keep_signal');
                //advanced_search_man
                Route::get('/man', [AdvancedsearchController::class, 'man'])->name('advanced_man');
                Route::match(['get','post'],'/result_man', [AdvancedsearchController::class, 'result_man'])->name('advanced_result_man');
                //advanced_search_extrenal_sign
                Route::get('/external_sign', [AdvancedsearchController::class, 'external_sign'])->name('advanced_external_sign');
                Route::match(['get','post'],'/result_external_sign', [AdvancedsearchController::class, 'result_external_sign'])->name('advanced_result_external_sign');
                //advanced_search_phone
                Route::get('/phone', [AdvancedsearchController::class, 'phone'])->name('advanced_phone');
                Route::match(['get','post'],'/result_phone', [AdvancedsearchController::class, 'result_phone'])->name('advanced_result_phone');
                //advanced_search_weapon
                Route::get('/weapon', [AdvancedsearchController::class, 'weapon'])->name('advanced_weapon');
                Route::match(['get','post'],'/result_weapon', [AdvancedsearchController::class, 'result_weapon'])->name('advanced_result_weapon');
                //advanced_search_car
                Route::get('/car', [AdvancedsearchController::class, 'car'])->name('advanced_car');
                Route::match(['get','post'],'/result_car', [AdvancedsearchController::class, 'result_car'])->name('advanced_result_car');
                //advanced_search_address
                Route::get('/address', [AdvancedsearchController::class, 'address'])->name('advanced_address');
                Route::match(['get','post'],'/result_address', [AdvancedsearchController::class, 'result_address'])->name('advanced_result_address');
                //advanced_search_work_activity
                Route::get('/work_activity', [AdvancedsearchController::class, 'work_activity'])->name('advanced_work_activity');
                Route::match(['get','post'],'/result_work_activity', [AdvancedsearchController::class, 'result_work_activity'])->name('advanced_result_work_activity');
                //advanced_search_man_bean_country
                Route::get('/man_bean_country', [AdvancedsearchController::class, 'man_bean_country'])->name('advanced_man_bean_country');
                Route::match(['get','post'],'/result_man_bean_country', [AdvancedsearchController::class, 'result_man_bean_country'])->name('advanced_result_man_bean_country');
                //advanced_search_objects_relation
                Route::get('/objects_relation', [AdvancedsearchController::class, 'objects_relation'])->name('advanced_objects_relation');
                Route::match(['get','post'],'/result_objects_relation', [AdvancedsearchController::class, 'result_objects_relation'])->name('advanced_result_objects_relation');
                //advanced_search_action
                Route::get('/action', [AdvancedsearchController::class, 'action'])->name('advanced_action');
                Route::match(['get','post'],'/result_action', [AdvancedsearchController::class, 'result_action'])->name('advanced_result_action');
                //advanced_search_control
                Route::get('/control', [AdvancedsearchController::class, 'control'])->name('advanced_control');
                Route::match(['get','post'],'/result_control', [AdvancedsearchController::class, 'result_control'])->name('advanced_result_control');
                //advanced_search_event
                Route::get('/event', [AdvancedsearchController::class, 'event'])->name('advanced_event');
                Route::match(['get','post'],'/result_event', [AdvancedsearchController::class, 'result_event'])->name('advanced_result_event');
                //advanced_search_signal
                Route::get('/signal', [AdvancedsearchController::class, 'signal'])->name('advanced_signal');
                Route::match(['get','post'],'/result_signal', [AdvancedsearchController::class, 'result_signal'])->name('advanced_result_signal');
                //advanced_search_organization
                Route::get('/organization', [AdvancedsearchController::class, 'organization'])->name('advanced_organization');
                Route::match(['get','post'],'/result_organization', [AdvancedsearchController::class, 'result_organization'])->name('advanced_result_organization');
                //advanced_search_mia_summary
                Route::get('/mia_summary', [AdvancedsearchController::class, 'organization'])->name('advanced_organization');
                Route::match(['get','post'],'/result_mia_summary', [AdvancedsearchController::class, 'result_mia_summary'])->name('advanced_result_mia_summary');
                //advanced_search_mia_summary
                Route::get('/criminal_case', [AdvancedsearchController::class, 'criminal_case'])->name('advanced_criminal_case');
                Route::match(['get','post'],'/result_criminal_case', [AdvancedsearchController::class, 'result_criminal_case'])->name('advanced_result_criminal_case');
            });
            // Route::get('simplesearch/simple_search_bibliography/1', [AdvancedsearchController::class, 'simple_search_bibliography'])->name('simple_search_bibliography');

           // Route::get('simplesearch/result_external_signs', [SimpleSearchController::class, 'result_external_signs']);

            Route::prefix('simplesearch')->group(function () {

                Route::get('/simple_search', [SimpleSearchController::class, 'simple_search'])->name('simple_search');

                Route::get('/simple_search_man/{type?}', [SimpleSearchController::class, 'simple_search_man'])->name('simple_search_man');
                Route::match(['get','post'],'/result_man/{type?}', [SimpleSearchController::class, 'result_man'])->name('result_man');
                // Route::get('/result_man', [SimpleSearchController::class, 'result_man'])->name('result_man');

                Route::get('/simple_search_address/{type?}', [SimpleSearchController::class, 'simple_search_address'])->name('simple_search_address');
                Route::match(['get','post'],'/result_address/{type?}', [SimpleSearchController::class, 'result_address'])->name('result_address');
                // Route::get('/result_address', [SimpleSearchController::class, 'result_address'])->name('result_address');

                Route::get('/simple_search_email', [SimpleSearchController::class, 'simple_search_email'])->name('simple_search_email');
                Route::post('/simple_search_email/{type}', [SimpleSearchController::class, 'simple_search_email'])->name('simple_search_email_type');
                Route::get('/simple_search_email/{type}', [SimpleSearchController::class, 'simple_search_email'])->name('simple_search_email_type_get');
                Route::post('/result_email/{type}', [SimpleSearchController::class, 'result_email'])->name('result_email_type');
                Route::post('/result_email', [SimpleSearchController::class, 'result_email'])->name('result_email_post');
                // Route::get('/result_email', [SimpleSearchController::class, 'result_email'])->name('result_email');
                Route::get('/simple_search_external_signs/{type?}', [SimpleSearchController::class, 'simple_search_external_signs'])->name('simple_search_external_signs');
                Route::match(['get','post'],'/result_external_signs/{type?}', [SimpleSearchController::class, 'result_external_signs'])->name('result_external_signs');
                // Route::get('/result_external_signs', [SimpleSearchController::class, 'result_external_signs'])->name('result_external_signs');

                //simple search car
                Route::get('/simple_search_car/{type?}', [SimpleSearchController::class, 'simple_search_car'])->name('simple_search_car');
                Route::match(['get','post'],'/result_car/{type?}', [SimpleSearchController::class, 'result_car'])->name('result_car');
                //simple search organization
                Route::get('/simple_search_organization/{type?}', [SimpleSearchController::class, 'simple_search_organization'])->name('simple_search_organization');
                Route::match(['get','post'],'/result_organization/{type?}', [SimpleSearchController::class, 'result_organization'])->name('result_organization');
                //simple search control
                Route::get('/simple_search_control/{type?}', [SimpleSearchController::class, 'simple_search_control'])->name('simple_search_control');
                Route::match(['get','post'],'/result_control/{type?}', [SimpleSearchController::class, 'result_control'])->name('result_control');
                //simple search phone
                Route::get('/simple_search_phone/{type?}', [SimpleSearchController::class, 'simple_search_phone'])->name('simple_search_phone');
                Route::match(['get','post'],'/result_phone/{type?}', [SimpleSearchController::class, 'result_phone'])->name('result_phone');
                //simple search mia summary
                Route::get('/simple_search_mia_summary/{type?}', [SimpleSearchController::class, 'simple_search_mia_summary'])->name('simple_search_mia_summary');
                Route::match(['get','post'],'/result_mia_summary/{type?}', [SimpleSearchController::class, 'result_mia_summary'])->name('result_mia_summary');
                //simple search objects relation
                Route::get('/simple_search_objects_relation/{type?}', [SimpleSearchController::class, 'simple_search_objects_relation'])->name('simple_search_objects_relation');
                Route::match(['get','post'],'/result_objects_relation/{type?}', [SimpleSearchController::class, 'result_objects_relation'])->name('result_objects_relation');
                //simple search bibliography
                Route::get('/simple_search_bibliography/{type?}', [SimpleSearchController::class, 'simple_search_bibliography'])->name('simple_search_bibliography');
                Route::match(['get','post'],'/result_bibliography/{type?}', [SimpleSearchController::class, 'result_bibliography'])->name('result_bibliography');
                //simple search criminal case
                Route::get('/simple_search_criminal_case/{type?}', [SimpleSearchController::class, 'simple_search_criminal_case'])->name('simple_search_criminal_case');
                Route::match(['get','post'],'/result_criminal_case/{type?}', [SimpleSearchController::class, 'result_criminal_case'])->name('result_criminal_case');
                //simple search event
                Route::get('/simple_search_event/{type?}', [SimpleSearchController::class, 'simple_search_event'])->name('simple_search_event');
                Route::match(['get','post'],'/result_event/{type?}', [SimpleSearchController::class, 'result_event'])->name('result_event');
                //simple search keep signal
                Route::get('/simple_search_keep_signal/{type?}', [SimpleSearchController::class, 'simple_search_keep_signal'])->name('simple_search_keep_signal');
                Route::match(['get','post'],'/result_keep_signal/{type?}', [SimpleSearchController::class, 'result_keep_signal'])->name('result_keep_signal');
                //simple search action
                Route::get('/simple_search_action/{type?}', [SimpleSearchController::class, 'simple_search_action'])->name('simple_search_action');
                Route::match(['get','post'],'/result_action/{type?}', [SimpleSearchController::class, 'result_action'])->name('result_action');
                //simple search man bean country
                Route::get('/simple_search_man_bean_country/{type?}', [SimpleSearchController::class, 'simple_search_man_bean_country'])->name('simple_search_man_bean_country');
                Route::match(['get','post'],'/result_man_bean_country/{type?}', [SimpleSearchController::class, 'result_man_bean_country'])->name('result_man_bean_country');
                //simple search signal
                Route::get('/simple_search_signal/{type?}', [SimpleSearchController::class, 'simple_search_signal'])->name('simple_search_signal');
                Route::match(['get','post'],'/result_signal/{type?}', [SimpleSearchController::class, 'result_signal'])->name('result_signal');
                //simple search weapon
                Route::get('/simple_search_weapon/{type?}', [SimpleSearchController::class, 'simple_search_weapon'])->name('simple_search_weapon');
                Route::match(['get','post'],'/result_weapon/{type?}', [SimpleSearchController::class, 'result_weapon'])->name('result_weapon');
                //simple search work activity
                Route::get('/simple_search_work_activity/{type?}', [SimpleSearchController::class, 'simple_search_work_activity'])->name('simple_search_work_activity');
                Route::match(['get','post'],'/result_work_activity/{type?}', [SimpleSearchController::class, 'result_work_activity'])->name('result_work_activity');


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
                Route::get('full_name', [ManController::class, 'fullName'])->name('man.full_name');

                Route::resource('email', ManEmailController::class)->only('create', 'store');

                Route::resource('phone', ManPhoneController::class)->only('create', 'store', 'edit');

                Route::resource('sign', ManSignController::class,)->only('create', 'store');

                Route::resource('sign-image', ManSignPhotoController::class)->only('create', 'store');

                Route::resource('organization', OrganizationHasManController::class)->only('create', 'store');

                Route::resource('bean-country', ManBeanCountryController::class)->only('create', 'store');

                Route::resource('person-address', AddressController::class)->only('create', 'store');


                Route::resource('signal-alarm', ManSignalController::class)->only('create', 'store');


                Route::resource('participant-action', ManEventController::class)->only('create', 'store');

                Route::resource('operational-interest', ManOperationalInterest::class)->only('create', 'store');

                Route::resource('signal-alarm', ManSignalController::class)->only('create', 'store');

                Route::resource('operational-interest-organization-man', ManOperationalInterestOrganization::class)->only('create', 'store');

                Route::resource('action-participant', ManActionParticipant::class)->only('create', 'store');

                Route::resource('alarm-check-object', AlarmCheckObjectController::class)->only('create', 'store');

                // Route::resource('criminal-case', CriminalCaseController::class)->only('create', 'store');
            });

            Route::resource('event', EventController::class)->only('edit', 'create', 'update');
            Route::resource('criminal_case', CriminalCaseController::class)->only('edit', 'create', 'update');

            Route::post('delete-teg-from-table', [ComponentService::class, 'deleteFromTable'])->name('delete_tag');



            Route::get('open/redirect/{id}', [OpenController::class, 'redirect'])->name('open.redirect');
            Route::get('open/{page}', [OpenController::class, 'index'])->name('open.page');
            Route::get('open/{page}/{id}', [OpenController::class, 'restore'])->name('open.page.restore');

            Route::get('page-redirect', [AddRelationService::class, 'page_redirect'])->name('page_redirect');
            Route::get('add-relation', [AddRelationService::class, 'add_relation'])->name('add_relation');

            Route::post('get-relations', [ModelRelationController::class,'get_relations'])->name('get_relations');
            Route::get('loging', [LogingController::class,'index'])->name('loging.index');


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


//37,38
// Կապն օբյեկտների միջև
//        Route::get('/event1', function () {
//            return view('event1.event');
//        })->name('event');



//Գործողություն
        Route::get('/action', function () {
            return view('action.action');
        })->name('action');

// 40) Գործողության մասնակից
// Իրադարձություն
            // Route::get('/man-event', function () {
            //     return view('action-participant.index');
            // })->name('man-event');

//43
//ահազանգ ??
//              Route::get('/alarm', function () {
//                return view('alarm.alarm');
//              })->name('alarm');
//





//Քրեական գործ
             Route::get('/criminalCase', function () {
               return view('criminal-case.index');
             })->name('criminalCase');
// 46
//Անցնում է ոստիկանության ամփոփագրով
              Route::get('/police', function () {
                return view('police.police');
              })->name('police');
//47
//Ավտոմեքենայի առկայություն
              Route::get('/availability-car', function () {
                return view('availability-car.availability-car');
              })->name('availability-car');
// 48
//Զենքի առկայություն
              Route::get('/availability-gun', function () {
                return view('availability-gun.availability-gun');
              })->name('availability-gun');
// 49
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
// 44



            // =======================================

            Route::get('/fusion', function () {
              return view('fusion.index');
          })->name('fusion');

          // ==========================================
            // translate route texapoxel
            Route::get('/translate/create_type', function () {
              return view('translate.create_type');
          })->name('create_type');

          // ===========================================


          // =========================================

            Route::get('/consistent-search', function () {
              return view('consistent-search.consistent-search');
            })->name('consistent-search');

            Route::get('/consistent-notifications', function () {
              return view('consistent-notifications.consistent-notifications');
            })->name('consistent-notifications');

              Route::get('/bibliography/summary-automatic', [SummeryAutomaticController::class, 'index'])->name('bibliography.summery_automatic');

            });

//Հաշվետվություն ըստ ահազանգերի
        Route::get('templatesearch/signal-report', function () {
            return view('template-search.signal-report');
          })->name('templatesearch_signal_report');

        Route::get('/home', [HomeController::class, 'index'])->name('home');
    }

);
