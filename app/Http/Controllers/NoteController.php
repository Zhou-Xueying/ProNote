<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\NoteBook;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function index($bookid){
        $notebook=NoteBook::find($bookid);
        $notes=$this->getNotesByBook($bookid);
        return view('selfcenter.note',['notebook'=>$notebook,'notes'=>$notes]);
    }

    public function getNotesByBook($bookid){
        $notes = Note::where('bookid',$bookid)->get();
        return $notes;
    }

    public function getMyNotes(){
        $notes = Note::where('userid',request()->user()->id)->get();
        return view('selfcenter.noteList',['notes'=>$notes]);
    }

    public function createNote(Request $request){
        $note = new Note();
        $note->bookid=$request->input('bookid');
        $note->bookname=NoteBook::find($request->input('bookid'))->get()->bookname;
        $note->userid=request()->user()->id;
        $note->content=$request->input('content');
        $note->save();
        return redirect('notebook/detail/'.$request->input('bookid'));
    }

    //soft delete
    public function softDeleteNote($noteId){
        $note = Note::find($noteId);
        $bookid = $note->bookid;
        $note->delete();
        return redirect('notebook/detail/'.$bookid);
    }

    //to note bin
    public function toRecycle(){
        $notes = $this->getDeletedNotes();
        return view('selfcenter.noteBin',['notes'=>$notes]);
    }

    //get deleted notes
    public function getDeletedNotes(){
        $userid = request()->user()->id;
        $notes = Note::onlyTrashed()->where('userid',$userid)->get();
        return $notes;
    }

    //restore deleted notes
    public function restoreDeletedNote($noteid){
        $note = Note::onlyTrashed()->find($noteid);
        if(NoteBook::find($note->bookid)==null){
            NoteBook::onlyTrashed()->find($note->bookid)->restore();
        }
        $note->restore();
        return redirect()->route('noteBin');
    }

    //restore all deleted notes
    public function restoreAllDeletedNotes(){
        $userid = request()->user()->id;
        $notes = Note::onlyTrashed()->where('userid',$userid)->get();
        foreach($notes as $note){
            if(NoteBook::find($note->bookid)==null){
                NoteBook::onlyTrashed()->find($note->bookid)->restore();
            }
        }
        Note::onlyTrashed()->where('userid',$userid)->restore();
        return redirect()->route('noteBin');
    }

    //delete completely
    public function deleteNoteCompletely($noteid){
        $note = Note::onlyTrashed()->find($noteid);
        $note->forceDelete();
        return redirect()->route('noteBin');
    }

    //clear the bin
    public function deleteAllNotesCompletely(){
        $userid = request()->user()->id;
        Note::onlyTrashed()->where('userid',$userid)->forceDelete();
        return redirect()->route('noteBin');
    }

    public function toDetail($noteid){
        $note = Note::find($noteid);
        $book = NoteBook::find($note->bookid);
        return view('selfcenter.noteDetail',['notebook'=>$book, 'note'=>$note]);
    }

    public function toUpdate($noteid){
        $note = Note::find($noteid);
        $book = NoteBook::find($note->bookid);
        return view('selfcenter.noteModify',['notebook'=>$book, 'note'=>$note]);
    }

    public function updateNote(Request $request){
        $note = Note::find($request->input('noteid'));
        $note->content = $request->input('content');
        $note->save();
        return redirect('note/detail/'.$note->noteid);
    }

    //upload File
    public function postFileupload(Request $request){
        //判断请求中是否包含name=file的上传文件
        if(!$request->hasFile('file')){
            exit('上传文件为空！');
        }
        $file = $request->file('file');
        //判断文件上传过程中是否出错
        if(!$file->isValid()){
            exit('文件上传出错！');
        }
        $destPath = realpath(public_path('images'));
        if(!file_exists($destPath))
            mkdir($destPath,0755,true);
        $filename = $file->getClientOriginalName();
        if(!$file->move($destPath,$filename)){
            exit('保存文件失败！');
        }
        exit('文件上传成功！');
    }

}
