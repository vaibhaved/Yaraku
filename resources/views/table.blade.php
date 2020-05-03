@extends('layouts.index');

@section('table')

    @if(count($books)>0)
        <table>
            <thead>
                <th>Title</th>
                <th>Author</th>
                <th>Edit</th>
                <th>Delete</th>
            </thead>
            <tbody>
                @foreach ($books as $book)
                    <tr>
                        <td>{{$book->title}}</td>
                        <td>{{$book->author}}</td>
                        <td><button class="btn"><i class="editIcon"></i></button></td>
                        <td><button class="btn"><i class="deleteIcon"></i></button></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <h3 style="text-align: center">No Books Found</h3>
    
    @endif

@endsection