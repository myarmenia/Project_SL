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
            $notifications = auth()->user()->unreadnotifications->toArray();
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
            $notification = auth()->user()->notifications()->where('id', $request->id)->first();
            if ($notification) {
                $notification->markAsRead();
            }
        }
        return redirect()->back()->with('success', 'Notification read successfully');
    }

}
