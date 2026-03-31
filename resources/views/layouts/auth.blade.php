<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Absensi Sekolah')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Poppins:wght@400;700&family=Texturina:wght@700&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            min-height: 100vh;
            background: linear-gradient(180deg, #596A5A 0%, #AFD0B1 100%);
            font-family: 'Inter', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .auth-wrapper {
            width: 100%;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
        }
    </style>
</head>
<body>
    <div class="auth-wrapper">
        @yield('content')
    </div>
</body>
</html>
