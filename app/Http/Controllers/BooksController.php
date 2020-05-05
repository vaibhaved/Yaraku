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
        return view('table',)->with('books',$books);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Search for books based on title or author or both
     */
    public function search(Request $request)
    {
        $title = $request->input('title');
        $author = $request->input('author');
        if ($title != NULL && $author != NULL)
        {
            $books = DB::select("SELECT * FROM books WHERE title='$title' AND author='$author';");
            return view('table')->with('books',$books);
        }
        else if ($title != NULL)
        {
            $books = DB::select("SELECT * FROM books WHERE title='$title';");
            return view('table')->with('books',$books);
        }
        else if ($author != NULL)
        {
            $books = DB::select("SELECT * FROM books WHERE author='$author';");
            return view('table')->with('books',$books);
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
            $this->validate($request, [
                'title' => 'required',
                'author' => 'required'
            ]);
    
            $book = new Book;
            $book->title = $request->input('title');
            $book->author = $request->input('author');
            $book->save();
    
            return redirect('/')->with('success', 'Book Added');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $this->validate($request, [
            'bookTitle' => 'required',
            'bookAuthor' => 'required'
        ]);

        $book = Book::find($id);
        $book->title = $request->get('bookTitle');
        $book->author = $request->get('bookAuthor');
        $book->save();
        return redirect('/')->with('success', 'Book Updated');
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
