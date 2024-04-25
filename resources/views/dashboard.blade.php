<!DOCTYPE html>
<html>

<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
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
    <div class="user-section">
        <img src="{{ asset('uploads/users/' . Auth::user()->photo) }}" alt="photo" style="width: 200px; height: 200px;">
        <h1>{{ Auth::user()->name }}</h1>
    </div>

    <div class="content-section">
        <h2>Welcome to dashboard</h2>
        <div class="food-section">
            <ul>
                <li><a href="/veg">Veg Section</a></li>
                <li><a href="/nonveg">Non-Veg Section</a></li>
                <li><a href="/dessert">Dessert Section</a></li>
            </ul>
        </div>
        <div class="logout-section">
            <form action="/logout" method="POST">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </div>
</body>

</html>