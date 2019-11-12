<?php

namespace App\Http\Controllers;

use App\Commons\JsonResponse;
use App\Notification;
use App\Notifications\TestNotification;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Exception;
//use pusher
use Pusher\Pusher;

class SendNotificationController extends Controller
{
    public function create()
    {
        return view('admin/notification');
    }

    public function store(Request $request)
    {
        $user = User::find(1); // id của user đã đăng kí ở trên, user này sẻ nhận được thông báo
        $data = $request->only([
            'title',
            'content',
        ]);
        $user->notify(new TestNotification($data));

        return view('notification');
    }
    public function getandfill(Request $request)
    {
        $start = $request->start;
        $limit = $request->length;
        if (Auth::user()->role == 2) {
            $notification = array_values(Notification::orderBy("created_at", 'DESC')
                ->offset($start)->limit($limit)->get()->toArray());
        } else {
            $notification = array_values(Notification::orderBy("created_at", 'DESC')
                ->offset($start)->limit($limit)->get()->toArray());
        }
        return response()->json(['data' => $notification, 'recordsFiltered' => Notification::count(), 'recordsTotal' => Notification::count(), 'raws' => 1]);
    }
    public function edit(Request $request)
    {
        $result = new JsonResponse();
        try {
            $user = User::find(2); // id của user đã đăng kí ở trên, user này sẻ nhận được thông báo
            $data = $request->only([
                'title',
                'content',
            ]);
            $user->notify(new TestNotification($data));

            $options = array(
                'cluster' => 'ap1',
                'encrypted' => true
            );

            $pusher = new Pusher(
                env('PUSHER_APP_KEY'),
                env('PUSHER_APP_SECRET'),
                env('PUSHER_APP_ID'),
                $options
            );
            $pusher->trigger('NotificationEvent', 'send-message', $data);
            $result->success(true);
        } catch (Exception $exception) {
            $result->fail($exception->getMessage());
        }
        return $result;
    }

}
