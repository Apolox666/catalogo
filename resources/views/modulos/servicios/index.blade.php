<x-app-layout>
    <div class="relative overflow-x-auto p-8">
        <div class="p-8 bg-white  shadow-xs rounded-xl">
            <h1 class=" text-black text-3xl py-8 font-bold">Servicios de TI</h1>

            <!-- boton de añadir -->
            <div class="w-8">
                <a href="{{ route('service.create') }}">
                    <button
                        class="rounded-lg relative w-36 h-10 cursor-pointer flex items-center border mb-4 border-green-500 bg-green-500 group hover:bg-green-500 active:bg-green-500 active:border-green-500">
                        <span
                            class="text-white font-bold ml-8 transform group-hover:translate-x-20 transition-all duration-300">Añadir
                        </span>
                        <span
                            class="absolute right-0 h-full w-10 rounded-lg bg-green-500 flex items-center justify-center transform group-hover:translate-x-0 group-hover:w-full transition-all duration-300">
                            <svg class="svg w-8 text-white" fill="none" height="24" stroke="currentColor"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24"
                                width="24" xmlns="http://www.w3.org/2000/svg">
                                <line x1="12" x2="12" y1="5" y2="19"></line>
                                <line x1="5" x2="19" y1="12" y2="12"></line>
                            </svg>
                        </span>
                    </button>
                </a>
            </div>
            <div class="overflow-x-auto mb-8 w-full rounded-lg border shadow-xs">
                <table class="table" id="Table">

                    <thead>
                        <tr class="bg-blue-500 text-white">
                            <th scope="col">Nombre</th>
                            <th scope="col">grupo encargado</th>
                            <th scope="col">Atencion</th>
                            <th scope="col">Subproceso</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($servicios as $servicio)
                            <tr class="row">

                                <td>{{ $servicio->name }}</td>
                                <td>
                                    @if ($servicio->group && $servicio->group->state != 0)
                                        {{ $servicio->group->name }}
                                    @else
                                        <!-- Aquí puedes mostrar un mensaje o dejar vacío el campo -->
                                        <span class="text-red-500">Sin grupo asignado</span>
                                    @endif
                                </td>
                                <td>{{ $servicio->schedule }}</td>
                                <td>
                                    @if ($servicio->subprocess && $servicio->subprocess->state != 0)
                                        {{ $servicio->subprocess->name }}
                                    @else
                                        <!-- Aquí puedes mostrar un mensaje o dejar vacío el campo -->
                                        <span class="text-red-500">Sin subproceso asignado</span>
                                    @endif
                                </td>


                                <td>
                                    <div class="flex gap-4 text-white items-center">
                                        <a href="{{ route('service.edit', $servicio->id) }}"
                                            class="px-4 p-2 items-center bg-blue-500 flex gap-2 rounded-md hover:bg-blue-400">
                                            <svg class="w-[16px] h-[16px] text-white" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                viewBox="0 0 20 18">
                                                <path
                                                    d="M12.687 14.408a3.01 3.01 0 0 1-1.533.821l-3.566.713a3 3 0 0 1-3.53-3.53l.713-3.566a3.01 3.01 0 0 1 .821-1.533L10.905 2H2.167A2.169 2.169 0 0 0 0 4.167v11.666A2.169 2.169 0 0 0 2.167 18h11.666A2.169 2.169 0 0 0 16 15.833V11.1l-3.313 3.308Zm5.53-9.065.546-.546a2.518 2.518 0 0 0 0-3.56 2.576 2.576 0 0 0-3.559 0l-.547.547 3.56 3.56Z" />
                                                <path
                                                    d="M13.243 3.2 7.359 9.081a.5.5 0 0 0-.136.256L6.51 12.9a.5.5 0 0 0 .59.59l3.566-.713a.5.5 0 0 0 .255-.136L16.8 6.757 13.243 3.2Z" />
                                            </svg>
                                            Editar
                                        </a>
                                        <button
                                            class="px-4 p-2 bg-red-500 flex gap-2 items-center rounded-md hover:bg-red-400 eliminar"
                                            href="#" data-id="{{ $servicio->id }}" data-url="">
                                            <svg class="w-[16px] h-[16px] text-white" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="M1 5h16M7 8v8m4-8v8M7 1h4a1 1 0 0 1 1 1v3H6V2a1 1 0 0 1 1-1ZM3 5h12v13a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V5Z" />
                                            </svg>
                                            Eliminar
                                        </button>

                                    </div>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/eliminar.js') }}"></script>
    <script>
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 1500
            });
        @endif
        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: '{{ session('error') }}',
                showConfirmButton: false,
                timer: 1500
            });
        @endif
    </script>
</x-app-layout>
