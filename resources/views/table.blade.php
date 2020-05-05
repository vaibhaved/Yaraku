@extends('layouts.index');

@section('table')
    
    @if(count($books)>0)
        <table>
            <h3 style="padding: 10px">Click on the fields to edit them and then click on save</h3>
            <thead>
                <th>Title</th>
                <th>Author</th>
                <th>Edit</th>
                <th>Delete</th>
            </thead>
            <tbody>
                @foreach ($books as $book)
                    <tr>
                        <form method="POST" action="{{ action('BooksController@update', $book->id)}}">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <td class="td-first" contenteditable="true"><input class="inputTable" type="text" value="{{$book->title}}" name="bookTitle"></td>
                            <td contenteditable="true"><input class="inputTable" type="text" value="{{$book->author}}" name="bookAuthor"></td>
                            <td><button class="btn" type="submit"><i class="editIcon"></i></button></td>
                        </form>
                        <form method="POST" action="{{ action('BooksController@destroy', $book->id)}}">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <td><button class="btn" type="submit"><i class="deleteIcon"></i></button></td>
                        </form>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <h3 style="text-align: center">No Books Found</h3>
    
    @endif

@endsection