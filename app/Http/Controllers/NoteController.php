<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\NoteBook;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;

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
        $note->bookname=NoteBook::find($request->input('bookid'))->bookname;
        $note->userid=request()->user()->id;
        $note->content=$request->input('content');
        $file = $request->file('file');
        if($file!=null){
            $note->filepath = $this->postFileupload($request);
        }
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

    public function getOtherNotes($bookid){
        $notes = Note::where('bookid',$bookid)->get();
        $notebook = NoteBook::find($bookid);
        return view('selfcenter.noteOfOther',['notes'=>$notes,'notebook'=>$notebook]);
    }

    public function otherNoteDetail($noteid){
        $note = Note::find($noteid);
        $book = NoteBook::find($note->bookid);
        return view('selfcenter.noteDetailOfOther',['notebook'=>$book, 'note'=>$note]);
    }

    //upload File
    public function postFileupload(Request $request){
        $path = $request->file('file')->store('file');
        return $path;
    }

    //dowmload file
    public function getFiledownload($noteid){
        $filePath = Note::find($noteid)->filepath;
        $filePath = str_replace('/','\\',$filePath);
        return response()->download(storage_path().'\\'.'app'.'\\'.$filePath);
    }

}
