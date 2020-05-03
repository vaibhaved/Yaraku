<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{config('app.name','Yaraku Test')}}</title>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>
    <body>
        <div class="container">
            <select value="Export" class="button">
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
            <div class="bookEntry">
                <ul>
                    <li>
                        <label for="title" class="required">Title</label>
                        <input type="text" id="title" name="bookTitle">
                    </li>
                    <li>
                        <label for="author" class="required">Author</label>
                        <input type="text" id="author" name="bookAuthor">
                    </li>
                </ul>
                <div>
                    <input type="button" value="Add" class="button addEntryButton">
                    <input type="button" value="Search" class="button searchButton">
                </div>
            </div>
            <div class="listBooks">
                @yield('table')
            </div>
        </div>
    </body>
</html>