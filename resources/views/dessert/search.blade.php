<!DOCTYPE html>
<html>

<head>
    <title>Search Dessert Items</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/search.css') }}">
</head>

<body>
    <div class="success">
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        @if (session('error'))
        <div class="alert alert-error">
            {{ session('error') }}
        </div>
        @endif
    </div>
    <div class="main">
        <div class="back">
            <a href="{{ route('dessert.index') }}">Back to Dessert Section</a>
        </div>
        <div class="showitem">
            @if($dessertitems->isNotEmpty())
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Spices</th>
                        <th>Recipe By</th>
                        <th>Uploaded</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dessertitems as $item)
                    <tr>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->spices }}</td>
                        <td>{{ $item->user->name }}</td>
                        <td>{{ $item->created_at->diffForHumans() }}</td>
                        <td>
                            <a href="{{ route('dessert.details', $item->id) }}">Details</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <p>No items found matching your search criteria.</p>
            @endif
        </div>
    </div>
</body>

</html>