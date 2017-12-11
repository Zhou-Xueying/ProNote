<?php

namespace App\Http\Controllers;

use App\Models\UserInfo;
use App\Models\Friendship;
use App\Models\FriendRequest;

class FriendController extends Controller{

    public function index(){
        return view();
    }

    public function apply($requestedid){
        if (!$this->isFriend(request()->user()->id, $requestedid)) {
            $application = new FriendRequest();
            $application->requesterid = request()->user()->id;
            $application->requestedid = $requestedid;
            $application->save();
            return true;
        }
        return false;
    }

    public function getMyApplications(){
        $userid = request()->user()->id;
        $requesterid = array();
        $applications = FriendRequest::where('requestedid',$userid)->get();
        foreach ($applications as $application){
            array_push($requesterid,$application->requesterid);
        }
        $requesterid = array_unique($requesterid);
        $requesters = UserInfo::where('userid',$requesterid[0]);
        for($i=1;$i<count($requesterid);$i++){
            $requesters = $requesters->orwhere('userid',$requesterid[$i]);
        }
        $requesters = $requesters->get();
        return view();
    }

    public function agree($requestid){
        $aplication = FriendRequest::find($requestid);
        $userid1 = $aplication->requestedid;
        $userid2 = $aplication->requesterid;
        if (!$this->isFriend($userid1, $userid2)) {
            $friendship = new Friendship();
            $friendship->user1id = $aplication->requestedid;
            $friendship->user2id = $aplication->requesterid;
            $friendship->save();
        }
        $aplication->delete();
    }

    public function disagree($requestid){
        FriendRequest::destroy($requestid);
    }

    public function getMyFriends(){
        $userid = request()->user()->id;
        $friendid = array();
        $friendship = Friendship::where('user1id',$userid)->get();
        foreach ($friendship as $ship){
            array_push($friendid,$ship->user2id);
        }
        $friendship = Friendship::where('user2id',$userid)->get();
        foreach ($friendship as $ship){
            array_push($friendid,$ship->user1id);
        }
        $friendid = array_unique($friendid);
        $friends = UserInfo::where('userid',$friendid[0]);
        for($i=1;$i<count($friendid);$i++){
            $friends = $friends->orwhere('userid',$friendid[$i]);
        }
        $friends = $friends->get();
        return view();
    }

    public function deleteFriend($friendid){
        $userid = request()->user()->id;
        $friendship1 = Friendship::where('user1id',$userid)->where('user2id', $friendid)->get();
        if(isset($friendship1)){
            $friendship1->delete();
            return redirect();
        }
        $friendship2 = Friendship::where('user2id',$userid)->where('user1id', $friendid)->get();
        if(isset($friendship2)){
            $friendship2->delete();
            return redirect();
        }
        return false;
    }

    public function isFriend($userid1,$userid2){
        $friendship1 = Friendship::where('user1id',$userid1)->where('user2id', $userid2)->get();
        $friendship2 = Friendship::where('user2id',$userid1)->where('user1id', $userid2)->get();
        return (isset($friendship1)||isset($friendship2));
    }
}
