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
            background-image: url("{{ asset('images/hero4.jpg') }}");
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
        }
    </style>
</head>

<body class="relative">
    @include('layouts.navbar')

    <section class="  py-20 md:py-0 w-full h-screen image relative z-0">
        <div class="flex flex-col text-center justify-center items-center  max-w-[1200px] w-[90%] mx-auto  h-full">
            <h2 class="font-bold text-4xl md:text-5xl lg:text-6xl text-white mb-10 md:mb-20">Consulta una actividad de
                la MSU</h2>
            <div class="relative w-full">
                <div class="flex">
                    <button class="py-2 px-4 bg-blue-700">
                        <i class="fas fa-search text-white"></i>
                    </button>
                    <input type="text" id="search" class="w-full  pr-4 py-2 focus:border-blue-700"
                    placeholder="Buscar...">
                    
                </div>
                
                
                <div id="search-results" class="bg-white rounded-full "></div>
            </div>
            
        </div>
    </section>



    <section class=" py-20 w-full h-full" id="que_es">
        <div class="text-center gap-10 flex mx-auto max-w-[1200px] w-[90%] overflow-hidden flex-col">
            <h2 class=" font-bold text-blue-700 text-3xl">¿Que es el catalogo TI?</h2>
            <div class="flex flex-col sm:flex-row gap-6">
                <div
                    class="group flex flex-col justify-start items-start gap-2 w-96 h-56 duration-500 relative rounded-lg p-4 bg-blue-700 hover:-translate-y-2 hover:shadow-xl shadow-gray-300">


                    <div class="">
                        <h2 class="text-2xl font-bold mb-2 text-white">Un catalogo</h2>
                        <p class=" flex text-gray-100  px-2 line-clamp-3">
                            Consulta informacion relevante acerca de los servicios prestados por el area de
                            tecnologia
                            dentro de SuperGiros.
                        </p>
                    </div>
                </div>
                <div
                    class="group flex flex-col justify-start items-start gap-2 w-96 h-56 duration-500 relative rounded-lg p-4 bg-blue-700 hover:-translate-y-2 hover:shadow-xl shadow-gray-300">
                    <div class="">
                        <h2 class="text-2xl font-bold mb-2 text-white">Una guia</h2>
                        <p class="flex text-gray-100 line-clamp-3">
                            El objetivo es guiar a las personas pertenecientes a supergiros en el proceso
                            de solicitar los servicios del area de tecnologia
                        </p>
                    </div>
                </div>
                <div
                    class="group flex flex-col justify-start items-start gap-2 w-96 h-56 duration-500 relative rounded-lg p-4 bg-blue-700 hover:-translate-y-2 hover:shadow-xl shadow-gray-300">
                    <div class="">
                        <h2 class="text-2xl font-bold mb-2 text-white">Objetivo</h2>
                        <p class="text-white line-clamp-3">
                            Presentar una herramienta web intuitiva para que la organizacion esté enterada de la
                            gestion
                            tecnologica
                            realizada
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    <script>
        $(document).ready(function() {
            $('#search').on('input', function() {
                var searchTerm = $(this).val();
                if (searchTerm.length >= 3) {
                    $.ajax({
                        url: "{{ route('activity.search') }}",
                        method: 'GET',
                        data: {
                            search: searchTerm
                        },
                        success: function(response) {
                            var activities = response.activities;
                            var resultsHtml = '<ul>';
                            activities.forEach(function(activity) {
                                // Genera la ruta con el ID de la actividad usando Blade
                                var showRoute = "{{ route('activity.show', ':id') }}";
                                showRoute = showRoute.replace(':id', activity.id);
                                resultsHtml +=
                                    '<li class="py-2 text-black bg-white"><a class="hover:text-blue-600 hover:font-bold" href="' +
                                    showRoute + '">' + activity.name + '</a></li>';
                            });
                            resultsHtml += '</ul>';
                            $('#search-results').html(resultsHtml);
                        }
                    });
                } else {
                    $('#search-results').html('');
                }
            });
        });
    </script>

</body>

</html>
