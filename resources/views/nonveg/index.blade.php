<!DOCTYPE html>
<html>

<head>
    <title>Non-Veg Section</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
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
        <div class="dashboard">
            <a href="{{ route('dashboard') }}">Return to dashoard</a>
        </div>
        <div class="search">
            <form action="{{ route('nonveg.search') }}" method="GET">
                <input type="text" name="query" placeholder="Search by name...">
                <button type="submit"><img src="icons/search.png"></button>
            </form>
        </div>
        <div class="add">
            <h4>Add New Item: </h4>
            <a href="{{ route('nonveg.create') }}"><img src="icons/add.png"></a>
        </div>
        <div class="showitem">
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
                    @foreach ($nonvegitems as $item)
                    <tr>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->spices }}</td>
                        <td>{{ $item->user->name }}</td> 
                        <td>{{ $item->created_at->diffForHumans() }}</td>
                        <td>
                            <a href="{{ route('nonveg.details', $item->id) }}">Details</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>