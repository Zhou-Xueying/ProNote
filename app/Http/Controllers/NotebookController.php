<?php

namespace App\Http\Controllers;

use App\Models\NoteBook;
use App\Models\Note;
use Illuminate\Http\Request;

class NotebookController extends Controller
{

    public function index()
    {
        $notebooks = $this->getBooksByUser();
        return view('selfcenter.notebook', ['notebooks' => $notebooks]);
    }

    //get someone's books
    public function getBooksByUser()
    {
        $books = NoteBook::where('userid', request()->user()->id)->get();
        return $books;
    }

    //create a new notebook
    public function createBook(Request $request)
    {
        $notebook = new NoteBook();
        $notebook->userid = request()->user()->id;
        $notebook->username = request()->user()->name;
        $notebook->bookname = $request->input('bookname');
        $notebook->summary = $request->input('summary');
        $notebook->tag = $request->input('tag');
        $notebook->authority = $request->input('authority');
        $notebook->save();
        return redirect('notebook');
    }

    //soft delete
    public function softDeleteBook($bookId)
    {
        NoteBook::find($bookId)->delete();
        Note::where('bookid', $bookId)->delete();
        return redirect('notebook');
    }

    //to notebook bin
    public function toRecycle()
    {
        $notebooks = $this->getDeletedBooks();
        return view('selfcenter.notebookBin', ['notebooks' => $notebooks]);
    }

    //get deleted books
    public function getDeletedBooks()
    {
        $userid = request()->user()->id;
        $books = NoteBook::onlyTrashed()->where('userid', $userid)->get();
        return $books;
    }

    //restore deleted books
    public function restoreDeletedBook($bookid)
    {
        NoteBook::onlyTrashed()->find($bookid)->restore();
        Note::onlyTrashed()->where('bookid', $bookid)->restore();
        return redirect()->route('bookBin');
    }

    //restore all deleted books
    public function restoreAllDeletedBooks()
    {
        $userid = request()->user()->id;
        $books = NoteBook::onlyTrashed()->where('userid', $userid)->get();
        foreach ($books as $book) {
            Note::onlyTrashed()->where('bookid', $book->bookid)->restore();
        }
        NoteBook::onlyTrashed()->where('userid', $userid)->restore();
        return redirect()->route('bookBin');
    }

    //delete completely
    public function deleteBookCompletely($bookid)
    {
        NoteBook::onlyTrashed()->find($bookid)->forceDelete();
        Note::withTrashed()->where('bookid', $bookid)->forceDelete();
        return redirect()->route('bookBin');
    }

    //clear the bin
    public function deleteAllBooksCompletely()
    {
        $userid = request()->user()->id;
        $books = NoteBook::onlyTrashed()->where('userid', $userid)->get();
        foreach ($books as $book) {
            Note::withTrashed()->where('bookid', $book->bookid)->forceDelete();
        }
        NoteBook::onlyTrashed()->where('userid', $userid)->forceDelete();
        return redirect()->route('bookBin');
    }

    //redirect to notebook modify page
    public function toUpdate($bookid)
    {
        $notebook = NoteBook::find($bookid);
        return view('selfcenter.notebookModify', ['notebook' => $notebook]);
    }

    //update notebook infomation
    public function updateBook(Request $request)
    {
        $book = Notebook::find($request->input('bookid'));
        $book->bookname = $request->input('bookname');
        $book->summary = $request->input('summary');
        $book->save();
        return redirect('notebook');
    }

    //goto a stranger's page
    public function toStrangerBookList($userid, $username){
        $books = NoteBook::where(['userid'=>$userid,'authority'=>'公开'])->get();
        return view('selfcenter.notebookOfOther',['notebooks'=>$books,'username'=>$username]);
    }

    //goto a friend's page
    public function toFriendBookList($userid, $username){
        $books = NoteBook::where('userid',$userid)->where('authority','<>','私密')->get();
        return view('selfcenter.notebookOfOther',['notebooks'=>$books,'username'=>$username]);
    }
}