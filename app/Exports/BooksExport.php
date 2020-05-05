<?php

namespace App\Exports;

use App\Book;
use Maatwebsite\Excel\Concerns\FromCollection;

class BooksExport implements FromCollection
{
    public function __construct($export) 
    {
        $this->export = $export;
    }

    /**
    * @return \Illuminate\Support\Collection
    * Export Books By Both Title and Author
    */
    public function collection()
    {

        if(strpos($this->export, 'title-author')!==FALSE)
            return Book::select('title','author')->get();
        else if(strpos($this->export, 'title')!==FALSE)
            return Book::select('title')->get();
        else if(strpos($this->export, 'author')!==FALSE)
            return Book::select('author')->get();
    }
}
