<?php

namespace App\Http\Controllers;

use App\Friend;
use App\User;
use Illuminate\Http\Request;

class FriendController extends Controller
{
    public function friendRequest($id)
    {
        if (\Auth::user()->id !== intval($id)) {
            $user1 = \Auth::user();
            $user2 = User::find($id);
            if ($user2) {
                $checkFriend1 = Friend::where('user1', $user1->id)->where('user2', $user2->id)->count();
                $checkFriend2 = Friend::where('user1', $user2->id)->where('user2', $user1->id)->count();

                if ($checkFriend1 != 0 || $checkFriend2 != 0) {
                    return redirect()->back();
                }
                $friendRequest = new Friend();
                $friendRequest->user1 = $user1->id;
                $friendRequest->user2 = $user2->id;
                $friendRequest->confirmed = 0;
                $friendRequest->save();
            } else {
                return redirect()->back();
            }
        }
        return redirect()->back();
    }
}
