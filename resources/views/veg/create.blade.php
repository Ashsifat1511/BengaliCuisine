<!DOCTYPE html>
<html>

<head>
    <title>Veg Item</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/create.css') }}">
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
            <a href="{{ route('veg.index') }}">Back to Veg Section</a>
        </div>
        <div class="form-container">
            <h2>Add New Veg Item</h2>
            <form action="{{ route('veg.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="spices">Spices:</label>
                    <input type="text" id="spices" name="spices" required>
                </div>
                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea id="description" name="description" required></textarea>
                </div>
                <div class="form-group">
                    <label for="image">Image:</label>
                    <input type="file" id="image" name="image" accept="image/*" required>
                </div>
                <div class="form-group">
                    <label for="recipe_by">Recipe By:</label>
                    <input type="text" id="user_id" name="user_id" value="{{ auth()->user()->username }}" readonly>
                </div>
                <div class="form-group
                    <label for=" category">Category:</label>
                    <select id="category" name="category" required>
                        <option value="veg">Veg</option>
                    </select>
                </div>
                <button type="submit">Add Dish</button>
            </form>
        </div>
    </div>
</body>

</html>