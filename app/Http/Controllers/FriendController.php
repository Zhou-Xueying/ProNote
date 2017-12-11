<?php

namespace App\Http\Controllers;

use App\Models\UserInfo;
use App\Models\Friendship;
use App\Models\FriendRequest;
use App\Models\NoteBook;

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
        }
        return redirect('notebook');
    }

    public function getMyApplications(){
        $userid = request()->user()->id;
        $requesterid = array();
        $applications = FriendRequest::where('requestedid',$userid)->get();
        $requesters = $applications;
        if(!$applications->isempty()) {
            foreach ($applications as $application) {
                array_push($requesterid, $application->requesterid);
            }
            $requesterid = array_unique($requesterid);
            $requesters = UserInfo::where('userid', $requesterid[0]);
            for ($i = 1; $i < count($requesterid); $i++) {
                $requesters = $requesters->orwhere('userid', $requesterid[$i]);
            }
            $requesters = $requesters->get();
        }
        return view('selfcenter.applicationList',['users'=>$requesters]);
    }

    public function agree($userid){
        $userid1 = request()->user()->id;
        $userid2 = $userid;
        if (!$this->isFriend($userid1, $userid2)) {
            $friendship = new Friendship();
            $friendship->user1id = $userid1;
            $friendship->user2id = $userid2;
            $friendship->save();
        }
        FriendRequest::where('requesterid',$userid2)->where('requestedid',$userid1)->delete();
        return redirect()->route('applicationList');
    }

    public function disagree($userid){
        FriendRequest::where('requesterid',$userid)->delete();
        return redirect()->route('applicationList');
    }

    public function getMyFriends(){
        $userid = request()->user()->id;
        $friendid = array();
        $friendship = Friendship::where('user1id',$userid)->get();
        $friends = $friendship;
        if(!$friendship->isempty()) {
            foreach ($friendship as $ship) {
                array_push($friendid, $ship->user2id);
            }
            $friendship = Friendship::where('user2id', $userid)->get();
            foreach ($friendship as $ship) {
                array_push($friendid, $ship->user1id);
            }
            $friendid = array_unique($friendid);
            $friends = UserInfo::where('userid', $friendid[0]);
            for ($i = 1; $i < count($friendid); $i++) {
                $friends = $friends->orwhere('userid', $friendid[$i]);
            }
            $friends = $friends->get();
        }
        return view('selfcenter.friendList',['users'=>$friends]);
    }

    public function deleteFriend($friendid){
        $userid = request()->user()->id;
        $friendship1 = Friendship::where('user1id',$userid)->where('user2id', $friendid)->get();
        if(!$friendship1->isempty()){
            Friendship::where('user1id',$userid)->where('user2id', $friendid)->delete();
        }
        $friendship2 = Friendship::where('user2id',$userid)->where('user1id', $friendid)->get();
        if($friendship2->isempty()){
            Friendship::where('user2id',$userid)->where('user1id', $friendid)->delete();
        }
        return redirect()->route('friendList');
    }

    public function isFriend($userid1,$userid2){
        $friendship1 = Friendship::where('user1id',$userid1)->where('user2id', $userid2)->get();
        $friendship2 = Friendship::where('user2id',$userid1)->where('user1id', $userid2)->get();
        return ( (!$friendship1->isempty()) || (!$friendship2->isempty()) );
    }

    public function getSharedBooks(){
        $userid = request()->user()->id;
        $friendid = array();
        $friendship = Friendship::where('user1id',$userid)->get();
        if(!$friendship->isempty()) {
            foreach ($friendship as $ship) {
                array_push($friendid, $ship->user2id);
            }
            $friendship = Friendship::where('user2id', $userid)->get();
            foreach ($friendship as $ship) {
                array_push($friendid, $ship->user1id);
            }
            $friendid = array_unique($friendid);

            $friends = array();

            foreach ($friendid as $friend){
                array_push($friends, $friend);
            }
            $books = NoteBook::where('userid',$friends[0]);
            for ($i = 1; $i < count($friends); $i++) {
                $books = $books->orwhere('userid', $friends[$i]);
            }
            $books = $books->get();
        }
        return view('selfcenter.sharedBooks',['notebooks'=>$books]);
    }
}
