<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserInfo;

class ProfileController extends Controller{

    public function index()
    {
        $profile = $this->getProfile();
        if (!isset($profile)) {
            $this->initialize();
        }
        $profile = $this->getProfile();
        return view('selfcenter.profile',compact('profile'));
    }

    public function initialize(){
        $profile = new UserInfo();
        $profile->userid = request()->user()->id;
        $profile->email = request()->user()->email;
        $profile->name = request()->user()->name;
//        $profile->gender = '男';
//        $profile->birthday = '1990-1-1';
//        $profile->address = '江苏省';
//        $profile->introduction = '你还没有填写个人简介呢，点击右上角【编辑】，让大家更好地认识你吧~';
        $profile->save();
    }

    public function getProfile(){
        $profile = UserInfo::find(request()->user()->id);
        return  $profile;
    }

    public function modify(){
        $profile = $this->getProfile();
        return view('selfcenter.profileModify',compact('profile'));
    }

    public function update(Request $request){
        $profile = UserInfo::find(request()->user()->id);
        $profile->name = $request->input('name');
        $profile->gender = $request->input('gender');
        $profile->birthday = $request->input('birthday');
        $profile->address = $request->input('address');
        $profile->introduction = $request->input('introduction');
        $profile->save();
        return redirect('profile');
    }

    public function showSomeonesProfile($userid){
        $profile = UserInfo::find($userid);
        return view('selfcenter.profileOfOther',compact('profile'));
    }
}