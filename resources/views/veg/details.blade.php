<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail View - {{ $item->name }}</title>
    <link rel="stylesheet" href="{{ asset('css/details.css') }}">
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
            <a href="{{ route('veg.index') }}">Return to Veg</a>
        </div>
        <div class="item-name">
            <h1>{{ $item->name }}</h1>
        </div>
        <div class="item-image">
            <img src="{{ asset('uploads/dishes/' . $item->image) }}" alt="{{ $item->name }}" style="width: 300px; height: 300px;">
        </div>

        <div class="item-spice">
            <p><strong>Spices:</strong> {{ $item->spices }}</p>
        </div>
        <div class="description-section">
            <p><strong>Description:</strong> {{ $item->description }}</p>
        </div>

    </div>
</body>

</html>