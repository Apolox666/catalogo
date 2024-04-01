@include('layouts/navbar')
<style>
    .image {
        background-image: url("{{ asset('images/hero4.jpg') }}");
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
    }
</style>
<div class="image flex items-center pt-20  h-full">
    <div class="container  flex mx-auto max-w-3xl">
        <div class="bg-white  overflow-hidden  shadow rounded-lg border">
            <div class="px-4 py-5 sm:px-6 flex gap-20">
                <div>
                    <h3 class="text-2xl">
                        <h1 class="text-blue-700 font-bold">{{ $activity->name }}</h1>
                    </h3>
                    <p class="mt-1 max-w-2xl text-sm text-black">
                        Detalles de actividad de la mesa de ayuda
                    </p>
                </div>
                <div>
                    <a href="{{ route('home') }}">
                        <button
                            class="overflow-hidden  w-32 p-2 h-12 bg-black text-white border-none rounded-md text-xl font-bold cursor-pointer relative z-10 group">
                            Volver
                            <span
                                class="absolute w-36 h-32 -top-8 -left-2 bg-white rotate-12 transform scale-x-0 group-hover:scale-x-100 transition-transform group-hover:duration-500 duration-1000 origin-left"></span>
                            <span
                                class="absolute w-36 h-32 -top-8 -left-2 bg-blue-400 rotate-12 transform scale-x-0 group-hover:scale-x-100 transition-transform group-hover:duration-700 duration-700 origin-left"></span>
                            <span
                                class="absolute w-36 h-32 -top-8 -left-2 bg-blue-700 rotate-12 transform scale-x-0 group-hover:scale-x-100 transition-transform group-hover:duration-1000 duration-500 origin-left"></span>
                            <span
                                class="group-hover:opacity-100 group-hover:duration-1000 duration-100 opacity-0 absolute top-2.5 left-8 z-10">Volver</span>
                        </button>
                    </a>
                </div>
            </div>
            <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
                <dl class="sm:divide-y sm:divide-gray-200">
                    <div class="py-2 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Subproceso encargado
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            <p>
                                @if ($activity->group->services->isNotEmpty() && $activity->group->services->first()->subprocess)
                                    {{ $activity->group->services->first()->subprocess->name }}
                                @else
                                    No hay subproceso responsable
                                @endif
                            </p>
    
                        </dd>
                    </div>
                    <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Tiempo de respuesta
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            <p> {{ $activity->time }}</p>
                        </dd>
                    </div>
                    <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Prioridad de la actividad
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            <p>{{ $activity->priority }}</p>
                        </dd>
                    </div>
                    <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Horarios de atencion
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            @if ($activity->group->services->isNotEmpty())
                                <p>Horario de Atención: {{ $activity->group->services->first()->schedule }}</p>
                            @endif
                        </dd>
                    </div>
                    <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Grupo y servicios encargados:
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            <p> {{ $activity->group->name }}</p>
                        </dd>
                    </div>
                    <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 items-center">
                        <dt class="text-sm font-medium text-gray-500">
                            Responsables de la actividad
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            @foreach ($activity->group->responsibles as $responsable)
                                <p> {{ $responsable->name }}</p>
                            @endforeach
                        </dd>
                    </div>
                   
                </dl>
            </div>
        </div>
    
    </div>
   
</div>
<footer class="bg-blue-700  shadow w-full">
    <div class="w-full mx-auto p-4 md:flex md:items-center md:justify-between">
        <span class="text-sm text-white sm:text-cente">© 2024 <a href="https://flowbite.com/"
                class="hover:underline">Red empresarial de servicios S.A.S™</a>. All Rights Reserved.
        </span>
    </div>
</footer>


