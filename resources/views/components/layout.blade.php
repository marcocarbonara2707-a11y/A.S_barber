<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>A.S_barber</title>
</head>
<body class="d-flex flex-column min-vh-100">

    <x-navbar/>

    <main class="flex-grow-1">
        {{ $slot }}
    </main>

    <x-footer/>

</body>
</html>