<x-app-layout>


    <div class="relative overflow-x-auto p-8">
        <div class="p-4 bg-white rounded-lg shadow-xs">
            <h1 class=" text-black text-3xl p-8 font-bold">Editar servicio</h1>
            <form method="POST" class="p-6" action="{{ route('service.update', $servicios->id) }}">
                @csrf
                @method('PATCH')
                <!-- nombre -->
                <div>
                    <x-input-label for="name" :value="__('Nombre del servicio *')" />
                    <x-text-input id="name"
                        class="block mt-6 w-full {{ $errors->has('name') ? 'border-red-600' : '' }}" type="text"
                        name="name" value="{{ $servicios->name }}" autofocus autocomplete="name" />

                    @error('name')
                        <p class="text-red-700 text-xs">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex flex-col mt-12">
                    <x-input-label for="hora_servicio" :value="__('Establezca el horario en el que se presta el servicio *')" />
                    <div class="flex gap-10 mt-4">
                        <div>
                            <x-input-label for="hora_inicio" :value="__('Hora inicio servicio *')" />
                            <input type="time" id="hora_inicio"
                                class="{{ $errors->has('hora_inicio') ? 'border-red-600' : '' }}" name="hora_inicio"
                                min="06:00" max="18:00" />
                        </div>
                        <div>
                            <x-input-label for="hora_fin" :value="__('Hora fin servicio *')" />
                            <input type="time" id="hora_fin"
                                class="{{ $errors->has('hora_fin') ? 'border-red-600' : '' }}" name="hora_fin"
                                min="09:00" max="18:00" />
                        </div>

                    </div>
                    @error('hora_inicio')
                        <p class="text-red-700 text-xs">{{ $message }}</p>
                    @enderror
                    @error('hora_fin')
                        <p class="text-red-700 text-xs">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex flex-col mt-12">
                    <x-input-label for="first_name" :value="__('Establezca el subproceso al que pertenece el servicio *')" />
                    <select name="subprocess" id="subprocess">
                        <option value="">Seleccione una opción</option>
                        @foreach ($subprocesos as $subproceso)
                            <option value="{{ $subproceso->id }}"
                                {{ $servicios->subprocesses_id == $subproceso->id ? 'selected' : '' }}>
                                {{ $subproceso->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                @error('name')
                    <p class="text-red-700 text-xs">{{ $message }}</p>
                @enderror
                <x-input-label for="name" :value="__('Seleccione a grupo encargado del servicio')" class="pt-8" />
                <div class="mb-4">
                    <input type="text" id="search" class="form-input rounded-md my-4 shadow-sm"
                        placeholder="Buscar por nombre">
                </div>
                @error('groups')
                    <p class="text-red-700 text-xs">{{ $message }}</p>
                @enderror




                <x-input-label for="groups" :value="__('Seleccione el grupo al que pertenecerá esta actividad')" class="pt-8" />
                <div class="flex flex-wrap  my-4 gap-8" id="groups-container">
                    @foreach ($grupos as $grupo)
                        <div class="w-1/4 flex items-center my-4 gap-4 group">
                            <input type="radio" name="groups" value="{{ $grupo->id }}"
                                {{ $servicios->group->id == $grupo->id ? 'checked' : '' }}>
                            <p>{{ $grupo->name }}</p>
                        </div>
                    @endforeach
                </div>





                <!-- acciones -->
                <div class="flex items-center justify-end mt-4">
                    <x-cancel-button class="ms-4">
                        {{ __('Cancelar') }}
                    </x-cancel-button>
                    <x-primary-button class="ms-4">
                        {{ __('Editar') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
    <script src="{{ asset('js/search.js') }}"></script>

</x-app-layout>
