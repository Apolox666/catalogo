@include('layouts/navbar')
<style>
    .image {
        background-image: url("{{ asset('images/hero4.jpg') }}");
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
    }
</style>
<div class="image mx-auto flex items-center pt-20  h-full">

    <div class="flex flex-col bg-white rounded-lg">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                <div class="overflow-hidden">


                    <table class="min-w-full text-left text-sm font-light text-surface 0  dark:text-white">
                        <thead class="border-b border-neutral-200 font-medium bg-blue-40 ">
                            <tr>
                                <th scope="col" class="px-6 py-4">Actividad</th>
                                <th scope="col" class="px-6 py-4">Subproceso</th>
                                <th scope="col" class="px-6 py-4">responsables</th>
                                <th scope="col" class="px-6 py-4">tiempo de respuesta</th>
                                <th scope="col" class="px-6 py-4">prioridad</th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b border-neutral-200 dark:border-white/10">
                                <td class="whitespace-nowrap px-6 py-4 text-blue-700 font-bold">{{ $activity->name }}
                                </td>
                                <td class="whitespace-nowrap px-6 py-4">
                                    @if ($activity->group->services->isNotEmpty() && $activity->group->services->first()->subprocess)
                                        {{ $activity->group->services->first()->subprocess->name }}
                                    @else
                                        No hay subproceso responsable
                                    @endif
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 ">
                                    @foreach ($activity->group->responsibles as $responsable)
                                        <p> {{ $responsable->name }}</p>
                                    @endforeach
                                </td>
                                <td class="whitespace-nowrap px-6 py-4">
                                    <p> {{ $activity->time }}</p>

                                </td>
                                <td class="whitespace-nowrap px-6 py-4">
                                    {{ $activity->priority }}
                                </td>
                                <td class="whitespace-nowrap px-6 py-4"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


</div>
<div class="relative w-full h-96">
    <iframe class="absolute top-0 left-0 w-full h-full"
        src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12080.73732861526!2d-74.0059418!3d40.7127847!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zM40zMDA2JzEwLjAiTiA3NMKwMjUnMzcuNyJX!5e0!3m2!1sen!2sus!4v1648482801994!5m2!1sen!2sus"
        frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0">
    </iframe>
</div>
</div>
<footer class="bg-blue-700  shadow w-full">
    <div class="w-full mx-auto p-4 md:flex md:items-center md:justify-between">
        <span class="text-sm text-white sm:text-cente">© 2024 <a href="https://flowbite.com/"
                class="hover:underline">Red
                empresarial de servicios S.A.S™</a>. All Rights Reserved.
        </span>
    </div>
</footer>


