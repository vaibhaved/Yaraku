<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use DB;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::orderBy('created_at','desc')->get();
        $sortby = 'created_at';
        $order = 'desc';
        return view('table',)->with(compact('books','sortby','order'));
    }

    public function sort(Request $request)
    {
        $sortby = $request->input('sortby');
        $order = $request->input('order');
        if ($sortby && $order) {
            $books = Book::orderBy($sortby, $order)->get();
        } else {
            $books = Book::orderBy('created_at','desc')->get();
        }
        return view('table')->with(compact('books', 'sortby', 'order'));
    }

    /**
     * Search for books based on title or author or both
     */
    public function search(Request $request)
    {
        $title = $request->input('title');
        $author = $request->input('author');
        $sortby = 'created_at';
        $order = 'desc';
        if ($title != NULL && $author != NULL)
        {
            $books = DB::select("SELECT * FROM books WHERE title LIKE '%$title%' AND author LIKE '%$author%';");
            return view('table')->with(compact('books','sortby','order'));
        }
        else if ($title != NULL)
        {
            $books = DB::select("SELECT * FROM books WHERE title LIKE '%$title%';");
            return view('table')->with(compact('books','sortby','order'));
        }
        else if ($author != NULL)
        {
            $books = DB::select("SELECT * FROM books WHERE author LIKE '%$author%';");
            return view('table')->with(compact('books','sortby','order'));
        }
        else
        {
            return redirect('/')->with('error','Atleast one of the two fields "title and author" should be present to perform search');
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->input('search'))
        {
            return $this->search($request);
        }
        else
        {
            if($request->input('title') && $request->input('author'))
            {
                $book = new Book;
                $book->title = $request->input('title');
                $book->author = $request->input('author');
                $book->save();
        
                return redirect('/')->with('success', 'Book Added');
            }
            else
            {
                return redirect('/')->with('error', 'Both The Fields "Title and Author" Are Required');
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($request->get('bookTitle') && $request->get('bookAuthor'))
        {
            $book = Book::find($id);
            $book->title = $request->get('bookTitle');
            $book->author = $request->get('bookAuthor');
            $book->save();
            return redirect('/')->with('success', 'Book Updated');
        }
        else
        {
            return redirect('/')->with('error', 'Some Fields are Empty. Book Not Updated!!!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::find($id);
        $book->delete();

        return redirect('/')->with('success', 'Book Removed');
    }
}
