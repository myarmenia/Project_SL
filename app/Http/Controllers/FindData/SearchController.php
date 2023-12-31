<?php

namespace App\Http\Controllers\FindData;

use App\Http\Controllers\FindData\BaseController;
use App\Http\Requests\AddCustomUserRequest;
use App\Models\DataUpload;
use App\Models\FileHasUrlData;
use App\Models\TempTables\TmpManFindText;
use App\Services\Filter\UploadDictionaryFilterService;
use App\Services\FindDataService;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\IOFactory;
use App\Services\SearchService;


class SearchController extends BaseController
{
  protected $searchService;

  public function __construct(SearchService $searchService, FindDataService $service)
  {
    parent::__construct($service);
    $this->searchService = $searchService;
  }

  public function showUploadForm()
  {
    $basePath = 'uploads/';
    $files = Storage::files($basePath);
    $cleanedFiles = array_map(function ($file) use ($basePath) {
      return str_replace($basePath, '', $file);
    }, $files);

    return view('search.upload', compact('cleanedFiles'));
  }

  public function uploadFile(Request $request)
  {
    info('uploadFile', [ (now()->minute * 60) + now()->second]);
    $bibliographyId = $request->input('bibliography_id');
    $file = $request->file('file');
    $fileName = '';

    if ($file) {
        $dataForUrl = $request->only(['table_name', 'colum_name_id', 'colum_name', 'bibliography_id']);
        $fileName = $this->searchService->uploadFile($file, $bibliographyId, $dataForUrl);
    } else {
      return back()->with('error', __('search.file_not_found'));
    }
    info('uploadFileEnd', [ (now()->minute * 60) + now()->second]);

    return redirect()->route('checked-file-data.file_data', ['locale' => app()->getLocale(), 'filename' => $fileName]);
  }

  public function showFileDetails($filename)
  {
    $fileType = [];
    return view('file-details', ['filename' => $filename, 'fileType' => $fileType]);
  }

  public function seeFileText()
  {
    // $lang = config('app.locale');

    // if(session()->has('locale')){
    //     $lang = session()->get('locale');
    // }

    // App::setLocale($lang);
    // dd( $request->getHost());

    return view('search.file-details');

  }

  public function file($lang, $filename)
  {
    $filePath = 'uploads/' . $filename;
    $fullPath = storage_path('app/' . $filePath);
//commented
    // if (Storage::exists($filePath)) {
    //
    //     $text = $this->searchService->getDocContent($fullPath);
    //     // var_dump($text);
    //     // print_r($text);
    //     // '/^([Ա-Ֆ][ա-ֆևv]+)\s+([Ա-Ֆ][ա-ֆև]+)\s+([Ա-Ֆ][ա-ֆև+)\s/ \d{2,}.\d{2,}.\d{2,}$/u';
    //     // $pattern = '/([Ա-Ֆ][ա-ֆև]+)\s+([Ա-Ֆ][ա-ֆև]+)\s+([Ա-Ֆ][ա-ֆև]+)/u';
    //     //default pattern Anun Hayranun Azganun /20.05.1888
    //     $pattern = '/([Ա-Ֆ][ա-ֆև]+)\s+([Ա-Ֆ][ա-ֆև]+)\s+([Ա-Ֆ][ա-ֆև]+)\s+\/\d{2,}.\d{2,}.\d{2,}/u';
    //     //defapatternTwoult pattern Anun Hayranun? Azganun /20.05.1888 || /1885
    //     $patternTwo = '/([Ա-Ֆ][ա-ֆև]+)\s+(([Ա-Ֆ][ա-ֆև]+)\s+)?([Ա-Ֆ][ա-ֆև]+)\s+\/(\d{2,}.)?(\d{2,}.)?\d{2,}/u';
    //     //defapatternThree pattern Anun ev Anun azganun
    //     // $patternThree = '/([Ա-Ֆ][ա-ֆև]+)\s+ և + \s ([Ա-Ֆ][ա-ֆև]+)\s+([Ա-Ֆ][ա-ֆև]+)/u';
    //     $patternThree = '/\/(.+?)\//u';

    //     //defpatternfour get address
    //     $patternFour = '/([Ա-Ֆ][ա-ֆև]+)\s+([Ա-Ֆ][ա-ֆև]+\s+)?([Ա-Ֆ][ա-ֆև]+)\s+\\/(.+?)\/ /u';

    //     //good work
    //     $patternFive = '/([Ա-Ֆ][ա-ֆև]+)\s+([Ա-Ֆ][ա-ֆև]+)\s+([Ա-Ֆ][ա-ֆև]+)\s+[\/\d{2,}.\d{2,}.\d{2,}]\s*(.+?)\//u';
    //     //version two good work
    //     // $patternSix = '/([Ա-Ֆ][ա-ֆև]+)\s+([Ա-Ֆ][ա-ֆև]+)\s+([Ա-Ֆ][ա-ֆև]+)\s+[\/\d{2,}.\d{2,}.\d{2,}]\s*(.+?)բն\.[0-9]+ /u';
    //     // $patternSix = '/([Ա-Ֆ][ա-ֆև]+)\s+([Ա-Ֆ][ա-ֆև]+)\s+([Ա-Ֆ][ա-ֆև]+)\s+[\/\d{2,}.\d{2,}.\d{2,}]\s*(.+?)\s*(բն\.[0-9]+. | \s*\/\s* | .\/. | \w+\/)/u';
    //     // $patternSix = '/([Ա-Ֆ][ա-ֆև]+)\s+([Ա-Ֆ][ա-ֆև]+)\s+([Ա-Ֆ][ա-ֆև]+)\s+\/(\d{2,}.\d{2,}.\d{2,})\s*(.+?)\s*(բն\.[0-9]+. | բն\.[0-9]+.\/.] | \s*\/\s* | .\/. | \w+\/. | \w+\/\/s* | \w+\/ | \w+.\/ | տ\.[0-9]+.)/u';
    //     // $patternSix = '/([Ա-Ֆ][ա-ֆև]+)\s+([Ա-Ֆ][ա-ֆև]+)\s+([Ա-Ֆ][ա-ֆև]+)\s+\/(\d{2,}.\d{2,}.\d{2,})\s*(.+?)\s*(բն\.[0-9]+. | բն\.[0-9]+.\/.] | \s*\/\s* | .\/. | \w+\/. | \w+\/\/s* | \w+\/ | \w+.\/ | տ\.[0-9]+.)/u';
    //     // $patternSix = '/(([Ա-Ֆ][ա-ֆև]+)\s+([Ա-Ֆ][ա-ֆև]+)\s+([Ա-Ֆ][ա-ֆև]+)\s+\/(\d{2,}.?\d{2,}.?\d{2,}?)\s*(.+?)\s*(բն\.[0-9]+. | բն\.[0-9]+.\/.] | \s*\/\s* | .\/. | \w+\/. | \w+\/\/s* | \w+\/ | \w+.\/ | տ\.[0-9]+.))/u';
    //     $patternSeven = '/([Ա-Ֆ][ա-ֆև]+)\s+([Ա-Ֆ][ա-ֆև]+\s+)?([Ա-Ֆ][ա-ֆև]+)\s+\/(\d{2,}.)?(\d{2,}.)?\d{2,}\s*(.+?)\s*(բն\.[0-9]+. | \s*\/\s* | .\/. | \w+\/. | \w+\/\/s* | \w+\/ | \w+.\/ | տ\.[0-9]+.)/u';


    //     $patternSix = '/(([Ա-Ֆ][ա-ֆև]+)\s+([Ա-Ֆ][ա-ֆև]+\s+)?([Ա-Ֆ][ա-ֆև]+\s+)?)\/((\d{2,}.)?(\d{2,}.)?\d{2,})\s*(.+?)\s*(բն\.[0-9]+. | \s*\/\s* | .\/. | \w+\/. | \w+\/\/s* | \w+\/ | \w+.\/ | տ\.[0-9]+.)/u';
    //     $patternEight = '/(([Ա-Ֆ][ա-ֆև]+)\s+([Ա-Ֆ][ա-ֆև]+\s+)?([Ա-Ֆ][ա-ֆև]+\s+)?)\/((\d{2,}.)?(\d{2,}.)?\d{2,})\s*(.+?)\s*(բն\.[0-9]+. | \s*\/\s* | .\/. | \w+\/. | \w+\/\/s* | \w+\/ | \w+.\/ | տ\.[0-9]+.)/u';

    //     $patternTest = '/(([Ա-Ֆ][ա-ֆև]+)\s+([Ա-Ֆ][ա-ֆև]+\s+)?([Ա-Ֆ][ա-ֆև]+\s+)?+\/((\d{2,}.)?(\d{2,}.)?\d{2,})\s*(.+?)\s*)(?:\s+բն\.)?/u';

    //     $patternKK ='/(([Ա-Ֆ][ա-ֆև]+)\s+([Ա-Ֆ][ա-ֆև]+\s+)?([Ա-Ֆ][ա-ֆև]+\s+)?)\/((\d{2,}.)?(\d{2,}.)?\d{2,})\s*(.+?)\//u';

    //     $parts =  explode("\t", $text);
    //     $textNewLines = implode("\n", $parts);
    //     // preg_match_all($pattern, $text, $matches, PREG_SET_ORDER);
    //     // preg_match_all($patternTwo, $text, $matchesTwo, PREG_SET_ORDER);
    //     var_dump($textNewLines);
    //     preg_match_all($patternSix, $textNewLines, $matchesFour, PREG_SET_ORDER);
    //     preg_match_all($patternTest, $textNewLines, $matchesThree, PREG_SET_ORDER);
    //     preg_match_all($patternKK, $textNewLines, $matchesKK, PREG_SET_ORDER);

    //     dd($matchesKK);


    //     return view('search.file-details', compact('content'));
    //     // return redirect()->route('fileShow', compact('content'));

    // } else {
    //     return 'File Not found.';
    // }



    $fileDetails = DataUpload::where('fileName', $filename)->get();

    return view('search.file-details', compact(['fileDetails', 'filename']));


  }

  public function reference()
  {
    return view('reference.reference');
  }

  public function destroyDetails($rowId)
  {
    DataUpload::destroy($rowId);

    return redirect()->back()->with('success', 'deleted');
  }

  public function editDetails($local, $id)
  {
    $details = DataUpload::find($id);

    return view('search.edit-details', compact('details'));
  }

  public function updateDetails(Request $request, $local, $id)
  {
    $details = $this->searchService->updateDetails($request->all(), $id);

    return redirect()->route('file.details', ['locale' => app()->getLocale(), 'filename' => $details->fileName])
      ->with('success', 'Row updated successfully');
  }

  public function editDetailItem(Request $request, $id)
  {
    $editedFileData = $this->searchService->editDetailItem($request->all(), $id);

    return response()->json($editedFileData);
  }

  public function showAllDetails()
  {
    $fileDetails = $this->searchService->showAllDetails();

    return view('search.all-details', compact('fileDetails'));
  }

  public function showAllDetailsDoc($lang, $filename)
  {
    $implodeArray = $this->searchService->showAllDetailsDoc($filename);

    return view('search.show-word', compact('implodeArray'));
  }

  public function index($lang, $fileName)
  {
    info('indexstart', [(now()->minute * 60) + now()->second]);

    $data = $this->searchService->checkedFileData($fileName);
    $diffList = $data['info'];
    $count = $data['count'];
    info('indexend', [ (now()->minute * 60) + now()->second]);


    return view('checked_file_data.checked_file_data', compact('diffList', 'fileName', 'count'));
  }

  public function likeFileDetailItem(Request $request)
  {
    $result = $this->searchService->likeFileDetailItem($request->all(), TmpManFindText::STATUS_MANUALLY_FOUND);

    return $result;
  }

  public function newFileDataItem(Request $request)
  {
    $result = $this->searchService->newFileDataItem($request->all());

    return $result;
  }

  public function showFile($lang, $fileName)
  {
    $implodeArray = $this->searchService->showAllDetailsDoc($fileName);

    $implodeArray = explode("\n", $implodeArray);

    return view('show-file.index', compact('implodeArray', 'fileName'));
  }

  public function bringBackLikedData(Request $request)
  {
    $bringedData = $this->searchService->bringBackLikedData($request->all());

    return response()->json($bringedData);
  }

  public function customAddFileData(AddCustomUserRequest $request, $fileName)
  {
    $customData = $this->searchService->customAddFileData($request->all(), $fileName);

    if($customData){
      return true;
    }

    return false;
  }

  public function uploadReference(Request $request)
  {
    $textLang = isset($request->text_lang) ? $request->text_lang : 'am';
    $phonetic = isset($request->phonetic) ? true : false;

    $bibliographyId = $request->input('bibliography_id');
    $file = $request->file('file');
    $fileName = '';

    if ($file) {
      $fileName = $this->searchService->uploadReference($file, $bibliographyId, $textLang, $phonetic);

      $dataForUrl = $request->only(['table_name', 'colum_name_id', 'colum_name', 'bibliography_id']);

      if($request->filled('table_name')){
        FileHasUrlData::create([
            'file_name' => $fileName,
            'url_data' => json_encode($dataForUrl)
        ]);
      }
    } else {
      return back()->with('error', __('search.file_not_found'));
    }

    return redirect()->route('checked-file-data.file_data', ['locale' => app()->getLocale(), 'filename' => $fileName]);

  }

  public function searchFilter(Request $request, $lang, $fileName, $page)
  {
    $request['page'] = $page;
    $result = $this->searchService->searchFilter($request->all(), $fileName);


    if($page != 1){
      $totalCount = TmpManFindText::where("file_name", $fileName)->count();
    }else{
      $totalCount = count($result['info']);
    }
        
    $readyResult = [
      'count' => $totalCount,
      'data' => $result['info'],
      'current_page' => $result['fileName']->currentPage(),
      'last_page' => $result['fileName']->lastPage()
    ];


    return response()->json($readyResult);

  }

}
