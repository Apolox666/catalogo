<x-app-layout>


    <div class="relative overflow-x-auto p-8">
      


        <div class="p-8 bg-white  shadow-xs rounded-xl">
            <h1 class=" text-black text-3xl py-8 font-bold">Usuarios registrados en el sistema</h1>
            <a href="{{ route('user.create') }}">
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
            <div class="overflow-hidden mb-8 w-full rounded-lg border shadow-xs">
                <table class="w-full text-sm text-left text-white rounded-md" id="Table">
                    <thead class="text-xs text-white uppercase bg-gray-700">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Nombre
                            </th>

                            <th scope="col" class="px-6 py-3">
                                Correo
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Fecha de creación
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Acciones
                            </th>
                        </tr>
                    </thead>

                    @foreach ($usuarios as $usuario)
                    @if ($usuario->id !== Auth::id())
                        <tbody>
                            <tr class="bg-white border-b user-row">
                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                    {{ $usuario->name }}
                                </td>

                                <td class="px-6 py-4 text-gray-900">
                                    {{ $usuario->email }}
                                </td>
                                <td class="px-6 py-4 text-gray-900">
                                    {{ $usuario->created_at }}
                                </td>
                                <td class="px-6 py-4 flex gap-4">
                                    <a href="{{ route('user.edit', $usuario->id) }}"
                                        class="px-4 p-2 bg-blue-500 flex gap-2 rounded-md hover:bg-blue-400">
                                        <svg class="w-[16px] h-[16px] text-white" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                                            <path
                                                d="M12.687 14.408a3.01 3.01 0 0 1-1.533.821l-3.566.713a3 3 0 0 1-3.53-3.53l.713-3.566a3.01 3.01 0 0 1 .821-1.533L10.905 2H2.167A2.169 2.169 0 0 0 0 4.167v11.666A2.169 2.169 0 0 0 2.167 18h11.666A2.169 2.169 0 0 0 16 15.833V11.1l-3.313 3.308Zm5.53-9.065.546-.546a2.518 2.518 0 0 0 0-3.56 2.576 2.576 0 0 0-3.559 0l-.547.547 3.56 3.56Z" />
                                            <path
                                                d="M13.243 3.2 7.359 9.081a.5.5 0 0 0-.136.256L6.51 12.9a.5.5 0 0 0 .59.59l3.566-.713a.5.5 0 0 0 .255-.136L16.8 6.757 13.243 3.2Z" />
                                        </svg>
                                        Editar
                                    </a>
                                    <button class="px-4 p-2 bg-red-500 flex gap-2 rounded-md hover:bg-red-400 eliminar"
                                        href="#" data-id="{{ $usuario->id }}">
                                        <svg class="w-[16px] h-[16px] text-white" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M1 5h16M7 8v8m4-8v8M7 1h4a1 1 0 0 1 1 1v3H6V2a1 1 0 0 1 1-1ZM3 5h12v13a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V5Z" />
                                        </svg>
                                        Eliminar
                                    </button>

                                </td>
                            </tr>
                        </tbody>
                        @endif
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script>
        $('.eliminar').click(function() {
            var id = $(this).data('id'); // Obtener el valor del atributo data-id
            Swal.fire({
                title: '¿Estás seguro de borrar este usuario?',
                text: "Recuerda que esta acción no se puede deshacer",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Sí, borrar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'DELETE',
                        url: "{{ route('user.destroy', ':id') }}".replace(':id', id),
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(respuesta) {
                            Swal.fire(
                                'Éxito',
                                'Cambios efectuados correctamente',
                                'success'
                            );
                            // Eliminar el elemento eliminado de la interfaz
                            $(`.eliminar[data-id=${id}]`).closest('.user-row').remove();
                        },
                        error: function(respuesta) {
                            Swal.fire(
                                'Error',
                                'Error desconocido',
                                'error'
                            );
                        }
                    });
                }
            });
        });
    </script>
</x-app-layout>
