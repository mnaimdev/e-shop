<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <!-- fontawesome cdn -->
    <script src="https://kit.fontawesome.com/deb5ec3c82.js" crossorigin="anonymous"></script>
    <!-- local css -->
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <title>Document</title>

</head>

<body class="relative">
    <!-- navbar from deasy ui -->
    <div class="w-screen mx-auto px-4 fixed z-50 bottom-5 hidden">
        <div class="navbar py-5 bg-black rounded-xl">
            <div class="w-full flex items-center px-4 py-4">
                <ul class="flex justify-between w-full">
                    <li><a href="{{ route('HOME') }}">home</a></li>
                    <li>explore</li>
                    <li><a href="{{ route('ORDERPLACED') }}">order</a></li>
                    <li>profile</li>
                </ul>
            </div>

        </div>
    </div>
    <!-- navbar end -->
    <main>
        @yield('content')
    </main>
    <!-- lotti json -->
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @yield('footer_scripts')
</body>

</html>
