<!DOCTYPE html>
<html>
<head>
    <title>Test Login</title>
</head>
<body>
    <h1>Test Login Siswa</h1>
    <form method="POST" action="{{ route('login.submit') }}">
        @csrf
        <input type="hidden" name="role" value="siswa">
        <div>
            <label>Username:</label>
            <input type="text" name="username" value="siswa_andi" required>
        </div>
       <div>
            <label>Password:</label>
            <input type="password" name="password" value="password" required>
        </div>
        <button type="submit">Login</button>
    </form>
</body>
</html>
