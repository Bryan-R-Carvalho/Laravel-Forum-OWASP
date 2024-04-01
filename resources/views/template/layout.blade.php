<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Twytter</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="shortcut icon" type="image/png" href="{{ asset('logo.png') }}" sizes="16x16" class="bg-white rounded-md">

</head>
<body class="bg-stone-100 container-xl">
    <div class="container">
        <header class="absolute inset-x-0 top-0 bg-slate-600 mb-1 ">
            <a href="{{ url('/') }}">
                <img class="absolute inset-x-0 mt-2 ml-2 w-8 p-1 bg-white rounded-md" src="{{ asset('logo.png') }}">
            </a>
            <nav class="flex items-center justify-between p-6 lg:px-8">
                <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-300 hover:text-gray-900 dark:text-gray-200 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="{{ route('logout') }}" class="ml-4 font-semibold text-gray-300 hover:text-gray-900 dark:text-gray-200 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500" onclick="event.preventDefault(); this.closest('form').submit();">Log out</a>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="font-semibold text-gray-300 hover:text-gray-900 dark:text-gray-200 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>
                        <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-300 hover:text-gray-900 dark:text-gray-200 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                    @endauth
                </div>
            </nav>
        </header>
    </div>
    @include('template.flash-message')
    @yield('body')
</body>
</html>