<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome</title>
    @vite('resources/css/app.css')
    {{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> --}}
    <style>
        header{
            height: 50px;
        }
        nav{
            height: 100%;
            display: flex;
            justify-content: space-evenly;
            align-items: center;
        }
    </style>
</head>
<body class="font-sans   text-white">
    <header class="bg-gray  bg-blue-900 shadow-2xl shadow-gray-900" >
        <nav>
            <a href="/login"><span>Login</span></a>
            <a href="/register"><span>Register</span></a>
            <a href="#"><span>About</span></a>
        </nav>
    </header>
    <main class="flex justify-center items-center w-full bg-blue-950" style="height: calc(100vh - 50px);">
        @yield('content')
    </main>
</body>
</html>
