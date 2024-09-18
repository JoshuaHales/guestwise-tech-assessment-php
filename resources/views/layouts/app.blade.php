<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Guestwise Tech Assessment</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="https://mab.starship-production.com/css/main.css">
    <link rel="stylesheet" type="text/css" href="https://mab.starship-production.com/css/utilities.css">

    @stack('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="https://mab.starship-production.com/logo.svg" alt="Guestwise Logo" height="30">
            </a>
        </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>

    @stack('scripts')
</body>
</html>
