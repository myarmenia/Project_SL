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
            $notifications = Auth::user()->notifications;;
            return view('consistent-notifications.index', compact('notifications'));
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }


    /**
     * this is a example for developers
     * @param Request $request
     */
    public function send(Request $request)
    {
        $data = [
            'name' => 'Shmavon',
            'search_text' => 'You received an offer.',
            'document_url' => url('/'),
            'type' => 'upload'
        ];

        Notification::send(Auth::user(), new ConsistentNotification($data));
    }


    /**
     * @param Request $request
     */
    public function read(Request $request)
    {
        Auth::user()->unreadNotifications()->where('notifications.id', $request->id)->markAsRead();
    }

}
