<?php

namespace App\Http\Controllers\SearchInclude;

use App\Http\Controllers\Controller;
use App\Models\ConsistentFollower;
use App\Models\ConsistentLibrary;
use App\Models\ConsistentSearch;
use App\Models\Library;
use App\Models\User;
use App\Notifications\ConsistentNotification;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ConsistentNotificationController extends Controller
{

    /**
     * @param $lang
     * @param int $first_page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index($lang, $first_page = 1)
    {
        try {
            $userUnreadNotification= auth()->user()->unreadNotifications;
            if($userUnreadNotification) {
                $userUnreadNotification->markAsRead();
            }
            $notifications = auth()->user()->notifications->toArray();
            return view('consistent-notifications.index', compact('notifications'));
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function read(Request $request)
    {
        if($request->id) {
            auth()->user()->notifications()->where('id', $request->id)->delete();
        }
        return redirect()->back()->with('success', 'Notification read successfully');
    }


    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function downloadFile(Request $request)
    {
        $check = storage_path().'/'.'app/'.$request->path;
        if(file_exists($check)) {
            return Storage::download($request->path);
        }
    }
}
