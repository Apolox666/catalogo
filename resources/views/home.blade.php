<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <title>Home</title>
    <style>
        .image {
            background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url("{{ asset('images/dashboard.png') }}");
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
        }
    </style>
</head>

<body class="relative">
    <header class="bg-gray-100 h-20 shadow-md fixed w-full z-50">
        <nav class="flex mx-auto max-w-[1200px] w-[90%] overflow-hidden items-center h-full justify-between">
            <a href="">
                <img src="{{ asset('/images/logo-supergiros.png') }}" alt="" width="180px">
            </a>

            <ul class="flex gap-8 font-bold text-lg">
                <li>
                    <a class="hover:text-blue-600 hidden md:flex" href="">Inicio</a>
                </li>
                <li>
                    <a class="hover:text-blue-600 hidden md:flex" href="http://localhost/assist/public/#que_es">Que es
                        MSU Assist</a>
                </li>
                @if (Route::has('login'))
                    <li>
                        @auth
                            <a class="text-white py-2 px-6 bg-blue-600 rounded-full hover:bg-blue-400 shadow-lg"
                                href="{{ route('dashboard') }}">Dashboard</a>
                        </li>
                    @else
                        <a href="{{ route('login') }}"
                            class="text-white py-2 px-6 bg-blue-600 rounded-full hover:bg-blue-400 shadow-lg"
                            wire:navigate>Login</a>
                    @endauth
                @endif
            </ul>
        </nav>
    </header>

    <section class="  py-20 md:py-0 w-full h-screen image relative z-0">
        <div class="flex flex-col text-center justify-center items-center  max-w-[1200px] w-[90%] mx-auto  h-full">
            <h2 class="font-bold text-4xl md:text-5xl lg:text-6xl text-white mb-10 md:mb-20">Consulta una habilidad de
                la MSU</h2>
            <div class="relative w-full">
                <input type="text" class="w-full rounded-full pl-14 pr-4 py-2 focus:border-blue-700"
                    placeholder="Buscar...">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                    <i class="fas fa-search text-blue-600"></i>
                </div>
            </div>
        </div>
    </section>




    <section class=" py-20 w-full h-full" id="que_es">
        <div class="text-center gap-10 flex mx-auto max-w-[1200px] w-[90%] overflow-hidden flex-col">
            <h2 class=" font-bold text-blue-700 text-3xl">¿Que es MSU Assist?</h2>
            <div class="flex flex-col sm:flex-row gap-6">
                <div
                    class="group flex flex-col justify-start items-start gap-2 w-96 h-56 duration-500 relative rounded-lg p-4 bg-blue-700 hover:-translate-y-2 hover:shadow-xl shadow-gray-300">
                   

                    <div class="">
                        <h2 class="text-2xl font-bold mb-2 text-white">Consulta los servicios TI</h2>
                        <p class="text-gray-100 line-clamp-3">
                           Consulta informacion relevante acerca de los servicios prestados por el area de tecnologia
                           dentro de SuperGiros.
                        </p>
                    </div>
                   
                </div>

                <div
                    class="group flex flex-col justify-start items-start gap-2 w-96 h-56 duration-500 relative rounded-lg p-4 bg-blue-700 hover:-translate-y-2 hover:shadow-xl shadow-gray-300">
                    <div class="absolute duration-700 shadow-md group-hover:-translate-y-4 group-hover:-translate-x-4 -bottom-10 -right-10 w-1/2 h-1/2 rounded-lg bg-gray-200"
                        alt="image here"></div>

                    <div class="">
                        <h2 class="text-2xl font-bold mb-2 text-white">Una guia</h2>
                        <p class="text-gray-100 line-clamp-3">
                           El objetivo es guiar a las personas pertenecientes a supergiros en el proceso 
                           de solicitar los servicios del area de tecnologia
                        </p>
                    </div>
                  
                </div>

                <div
                    class="group flex flex-col justify-start items-start gap-2 w-96 h-56 duration-500 relative rounded-lg p-4 bg-gray-100 hover:-translate-y-2 hover:shadow-xl shadow-gray-300">
                    <div class="absolute duration-700 shadow-md group-hover:-translate-y-4 group-hover:-translate-x-4 -bottom-10 -right-10 w-1/2 h-1/2 rounded-lg bg-gray-200"
                        alt="image here"></div>

                    <div class="">
                        <h2 class="text-2xl font-bold mb-2 text-gray-800">Card</h2>
                        <p class="text-gray-700 line-clamp-3">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean convallis
                            magna quis lectus fermentum, quis scelerisque orci pellentesque. Duis id
                            porta justo. Sed ac enim id justo tincidunt hendrerit id ac lectus.
                            Pellentesque maximus posuere tortor vitae consequat.
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <footer class="bg-blue-700  shadow w-full">
        <div class="w-full mx-auto p-4 md:flex md:items-center md:justify-between">
            <span class="text-sm text-white sm:text-cente">© 2024 <a href="https://flowbite.com/"
                    class="hover:underline">Red empresarial de servicios S.A.S™</a>. All Rights Reserved.
            </span>
        </div>
    </footer>

</body>

</html>
