<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>TCC</title>
    <script src="https://cdn.tailwindcss.com"></script>

</head>
<body class="bg-stone-100 ">
    <div class="container">
        <header class="absolute inset-x-0 top-0 z-50 bg-slate-600 mb-1 ">
            <nav class="flex items-center justify-between p-6 lg:px-8 " aria-label="Global">
                @if (Route::has('login'))
                    <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-300 hover:text-gray-900 dark:text-gray-200 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="font-semibold text-gray-300 hover:text-gray-900 dark:text-gray-200 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-300 hover:text-gray-900 dark:text-gray-200 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                            @endif
                        @endauth
                    </div>
                @endif
            </nav>
        </header>
    </div>
@yield('body')
</body>
</html>