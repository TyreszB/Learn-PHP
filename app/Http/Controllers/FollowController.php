<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Follow;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function createFollow(User $user) {

        if ($user->id === auth()->user()->id) {
            back()->with('failure', 'You cannot follow yourself.');
        }

        $existCheck = Follow::where([['user_id','=', auth()->user()->id],['followeduser', '=', $user->id]])->count();

        if ($existCheck) {
            return back()->with('failure', 'You are already following that user.');
        }

        $newFollow = new Follow;
        $newFollow->user_id = auth()->user()->id;
        $newFollow->followeduser = $user->id;
        $newFollow->save();
        
        return back()->with('success', 'User successfullly followed');
    }

    public function removeFollow(User $user) {
        Follow::where([['user_id', '=', auth()->user()->id],['followeduser', '=', $user->id]]);
        return back()->with('success', 'User successfully unfollowed.');
    }
}
