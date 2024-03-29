
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ url('login') }}" method="POST">
        @csrf
        <div>
            <label for="username">Username:</label><br>
            <input type="text" id="username" name="username" value="{{ old('username') }}" required autofocus><br>
        </div>
        <div>
            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" required><br>
        </div>
        <div>
            <button type="submit">Login</button>
        </div>
    </form>
</body>
</html>
