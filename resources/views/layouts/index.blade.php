<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{config('app.name','Yaraku Test')}}</title>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <script src="{{ asset('js/app.js') }}"></script>
    </head>
    <body>
        <div class="container">
            @include('inc.messages')
            <form method="POST" action="/export">
                {{ csrf_field() }}
                <select name="Export"class="button">
                    <option value="Export">Export</option>
                    <optgroup label="CSV">
                        <option value="title-author-csv">List with both Title and Author</option>
                        <option value="title-csv">List with only Title</option>
                        <option value="author-csv">List with only Author</option>
                    <optgroup label="XML">
                        <option value="title-author-xml">List with both Title and Author</option>
                        <option value="title-xml">List with only Title</option>
                        <option value="author-xml">List with only Author</option>
                </select>
                <input type="submit" value="Download" name="download" class="button">
            </form>
            <div class="bookEntry">
                
                <form method="POST" action="{{ action('BooksController@store') }}">
                    {{ csrf_field() }}
                    <ul>
                        <li>
                            <label for="title" class="required">Title</label>
                            <input type="text" id="title" name="title">
                        </li>
                        <li>
                            <label for="author" class="required">Author</label>
                            <input type="text" id="author" name="author">
                        </li>
                    </ul>
                    <div>
                        <input type="submit" value="Add" class="button addEntryButton">
                        <input type="submit" value="Search" name="search" class="button">
                        <a href="/"><input type="button" value="Reset" class="button"></a>
                    </div>
                </form>
            </div>
            <div class="listBooks">
                @yield('table')
            </div>
        </div>
    </body>
</html>