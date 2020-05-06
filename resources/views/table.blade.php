@extends('layouts.index');

@section('table')
    
    @if(count($books)>0)
        <table>
            <div style="display: inline-block; padding: 10px">
                <h3 style="margin: 0; float: left;">Click on the fields to edit them and then click on save</h3>
            </div>
            <thead>
                <th>@if ($sortby == 'title' && $order == 'asc')
                    {{
                        link_to_action(
                            'BooksController@sort',
                            'Title',
                            array(
                                'sortby' => 'title',
                                'order' => 'desc'
                            )
                        )
                    }}
                    @else {{
                        link_to_action(
                            'BooksController@sort',
                            'Title',
                            array(
                                'sortby' => 'title',
                                'order' => 'asc'
                            )
                        )
                    }}
                    @endif
                </th>
                <th>@if ($sortby == 'author' && $order == 'asc')
                    {{
                        link_to_action(
                            'BooksController@sort',
                            'Author',
                            array(
                                'sortby' => 'author',
                                'order' => 'desc'
                            )
                        )
                    }}
                    @else {{
                        link_to_action(
                            'BooksController@sort',
                            'Author',
                            array(
                                'sortby' => 'author',
                                'order' => 'asc'
                            )
                        )
                    }}
                    @endif
                </th>
                <th>Edit</th>
                <th>Delete</th>
            </thead>
            <tbody>
                @foreach ($books as $book)
                    <tr>
                        <form method="POST" action="{{ action('BooksController@update', $book->id)}}">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <td class="td-first"><input class="inputTable" type="text" value="{{$book->title}}" name="bookTitle"></td>
                            <td><input class="inputTable" type="text" value="{{$book->author}}" name="bookAuthor"></td>
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