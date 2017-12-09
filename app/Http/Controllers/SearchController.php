<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserInfo;
use App\Models\NoteBook;

class SearchController extends Controller{

    public function search(Request $request){
        $type = $request->input('searchType');
        $keyword = $request->input('keyword');
        if($type=='用户'){
           return redirect('search/user/'.$keyword);
        }else{
            return redirect('search/book/'.$keyword);
        }
    }

    public function searchUser($keyword){
        $users = UserInfo::where('name', 'like', '%'.$keyword.'%')->get();
        return view('selfcenter.userList', ['users' => $users]);
    }

    public function searchBook($keyword){
        $books = NoteBook::where('tag',$keyword)->get();
        return view('selfcenter.bookList',['books'=>$books]);
    }
}