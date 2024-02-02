<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Follow;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

class UserController extends Controller
{

    public function showAvatarForm() {
        return view('avatar-form');
    }

    public function storeAvatar(Request $request){
        $request->validate([
            'avatar'=> 'required|image'
        ]);

        $user = auth()->user();

        $filename = $user->id. '-' . uniqid() . '.jpg';

       $imgData = Image::make($request->file('avatar'))->fit(120)->encode('jpg');
       Storage::put('public/avatars/' . $filename, $imgData);

       $oldAvatar = $user->avatar;

       $user->avatar = $filename;

       $user->save();

       if($oldAvatar != "/fallback-avatar.jpg") {
        Storage::delete(str_replace("storage", "public/", $oldAvatar));
       }

       return back()->with('success', 'Congrats on the new avatar!');
    }


    public function showCorrectHomepage() {
        if (auth()->check()) {
            return view('homepage-feed', ['posts' => auth()->user()->feedPosts()->latest()->paginate(4)]);
        } else {
            return view('homepage');
        }
        
    }

    public function logout(){
        auth()->logout();
        return redirect('/')->with('success', 'You have succesfully logged out!');

    }
    

    public function login(Request $request) {
        $incomingFields = $request->validate([
            'loginusername' => 'required',
            'loginpassword' => 'required'
        ]);

        if(auth()->attempt(['username' => $incomingFields['loginusername'], 'password' => $incomingFields['loginpassword']])) {
            $request->session()->regenerate();
            return redirect('/')->with('success', 'You have succesfully logged in!');

        } else {
            return redirect('/')->with('error', 'Invalid Login');
        }
    }


    public function register(Request $request) {
        $incomingFields = $request->validate([
            'username' => ['required', 'min:3', 'max:20', Rule::unique('users', 'username')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:8', 'confirmed']
        ]);

        $incomingFields['password'] = bcrypt($incomingFields['password']);

        $user = User::create($incomingFields);

        auth()->login($user);
        return redirect('/')->with('success', 'Thank you for signing up!');

    }

    private function getData($user) {
        $currentlyFollowing = 0;

        if (auth()->check()) {
            $currentlyFollowing = Follow::where([['user_id', '=', auth()->user()->id], ['followeduser', '=', $user->id]])->count();
        }

        View::share('userData', ['currentlyFollowing' => $currentlyFollowing, 'avatar' => $user->avatar, 'username' => $user->username, 'postCount' => $user->post()->count(), 'followerCount' => $user-> followers()->count(), 'followingCount' => $user->following()->count() ]);
    }

    public function userProfile(User $user) {
       $this->getData($user);
        
        return view('/profile-post', ['posts' => $user->post()->latest()->get()]);
    }

    public function userProfileFollowers(User $user) {
        $this->getData($user);

        return view('/profile-followers', ['followers' => $user->followers()->latest()->get()]);
    }

    public function userProfileFollowing(User $user) {
        $this->getData($user);
        
        return view('/profile-following', ['following' => $user->following()->latest()->get()]);
    }
}
