<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mayden Shopping List</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <style>
            /* Tailwind CSS or custom styles */
            /* Ensure you include the necessary Tailwind classes if needed */
        </style>
    @endif
</head>
<body class="bg-gray-100 font-sans antialiased">

<!-- Page Content -->
<div
    class="min-h-screen flex flex-col justify-center items-center">
    <div class="text-center mb-8">
        <p class="font-semibold text-gray-800 mb-4">Please login to view your shopping list</p>
        <div class="space-x-6">
            <a href="{{ route('login') }}"
               class="bg-blue-200 text-gray-800 px-6 py-3 rounded-md hover:bg-blue-300 transition duration-300">Login</a>
            <a href="{{ route('register') }}"
               class="bg-orange-200 text-gray-800 px-6 py-3 rounded-md hover:bg-orange-300 transition duration-300">Register</a>
        </div>
    </div>
</div>

</body>
</html>
