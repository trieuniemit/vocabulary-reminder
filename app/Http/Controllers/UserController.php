<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    function logout() {
        auth()->logout();
        // redirect to homepage
        return redirect('/');
    }
    // Đánh dấu người dùng đã đọc
    public function follow(User $user)
    {
        $follower = auth()->user();
        if ( ! $follower->isFollowing($user->id)) {
            $follower->follow($user->id);

            // add this to send a notification
            $user->notify(new UserFollowed($follower));

            return back()->withSuccess("You are now friends with {$user->name}");
        }
        return back()->withSuccess("You are already following {$user->name}");
    }
    //...
//    // Notifi trả về ít nhất 5 thông báo chưa đọc.
//    public function notifications()
//    {
//        return auth()->user()->unreadNotifications()->limit(5)->get()->toArray();
//    }
    public function getandfill(Request $request)
    {
//        $start = $request->start;
//        $limit = $request->length;
        $user = array_values(User::orderBy("created_at", 'DESC')->toArray());
//                ->offset($start)->limit($limit)->get()->toArray());
        dd($user);
        return response()->json(['data' => $user, 'recordsFiltered' => User::count(), 'recordsTotal' => User::count(), 'raws' => 1]);
    }
}
