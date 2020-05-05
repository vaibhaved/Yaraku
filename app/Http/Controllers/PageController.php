<?php

namespace App\Http\Controllers;

use App\Book;
use App\Exports\BooksExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{
    public function index() {
        return view('layouts.index');
    }

    public function export(Request $request) {
        $export = $request->input('Export');
        if (strpos($export, 'csv'))
        {
            return Excel::download(new BooksExport($export), 'books.csv');
        }
        else if (strpos($export, 'xml'))
        {
            $books = Book::all();
            $xml = new \XMLWriter();
            $xml->openMemory();
            $xml->setIndent(true);

            $xml->startDocument();

            $xml->startElement('books');

            if(strpos($export, 'title-author')!==FALSE)
            {
                foreach ($books as $book) {
                    $xml->startElement('book');
                    $xml->writeAttribute('title', $book->title);
                    $xml->writeAttribute('author', $book->author);
                    $xml->endElement();
                }
            }
            else if(strpos($export, 'title')!==FALSE)
            {
                foreach ($books as $book) {
                    $xml->startElement('book');
                    $xml->writeAttribute('title', $book->title);
                    $xml->endElement();
                }
            }
            else if(strpos($export, 'author')!==FALSE)
            {
                foreach ($books as $book) {
                    $xml->startElement('book');
                    $xml->writeAttribute('author', $book->author);
                    $xml->endElement();
                }
            }
            $xml->endElement();
            $xml->endDocument();

            header('Content-Disposition: attachment; filename=books.xml');
            header('Content-Type: text/xml');

            $contents = $xml->outputMemory();

            $xml = null;

            return $contents;
            
        }
        else
        {
            return redirect('/')->with('error', 'Please select an option from the drop-down list');
        }
    }
}
