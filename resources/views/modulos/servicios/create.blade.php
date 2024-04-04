<x-app-layout>


    <div class="relative overflow-x-auto p-8">
        <div class="p-4 bg-white rounded-lg shadow-xs">
            <h1 class=" text-black text-3xl p-8 font-bold">Registrar un nuevo servicio</h1>
            <form method="POST" class="p-6" action="{{ route('service.store') }}">
                @csrf

                <!-- nombre -->
                <div>
                    <x-input-label for="name" :value="__('Nombre del servicio *')" />
                    <x-text-input id="name"
                        class="block mt-6 w-full {{ $errors->has('name') ? 'border-red-600' : '' }}" type="text"
                        name="name" :value="old('name')" autofocus autocomplete="name" />

                    @error('name')
                        <p class="text-red-700 text-xs">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex flex-col mt-12">
                    <x-input-label for="hora_servicio" :value="__('Establezca el horario en el que se presta el servicio *')" />
                    <div class="flex gap-10 mt-4">

                        <div>
                            <x-input-label for="hora_inicio" :value="__('Hora inicio servicio *')" />
                            <input type="time" class="{{ $errors->has('hora_inicio') ? 'border-red-600' : '' }}" id="hora_inicio" name="hora_inicio" min="06:00" max="18:00" />
                        </div>

                        <div>
                            <x-input-label for="hora_fin" :value="__('Hora fin servicio *')" />
                            <input type="time" class="{{ $errors->has('hora_fin') ? 'border-red-600' : '' }}" id="hora_fin" name="hora_fin" min="09:00" max="18:00" />
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
                    <x-input-label for="subprocess" :value="__('Establezca el subproceso al que pertenece el servicio *')" />
                    <select name="subprocess" id="" class="{{ $errors->has('subprocess') ? 'border-red-600' : '' }}">

                        <option value="">Seleccione una opcion</option>
                        @foreach ($subprocesos as $subproceso)
                            <option value="{{ $subproceso->id }}">{{ $subproceso->name }}</option>
                        @endforeach
                    </select>
                    @error('name')
                        <p class="text-red-700 text-xs">{{ $message }}</p>
                    @enderror
                </div>
                <x-input-label for="name" :value="__('Seleccione el grupo encargado del servicio')" class="pt-8" />
                <div class="mb-4">
                    <input type="text" id="search" class="form-input rounded-md my-4 shadow-sm"
                        placeholder="Buscar por nombre">
                </div>
                @error('groups')
                    <p class="text-red-700 text-xs">{{ $message }}</p>
                @enderror



                <div class="flex flex-wrap gap-8" id="groups-container">
                    @foreach ($grupos as $grupo)
                        <div class="w-1/4 flex items-center gap-4 search">
                            <input type="radio" name="groups" value="{{ $grupo->id }}">
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
                        {{ __('Registrar') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
    <script src="{{ asset('js/search.js') }}"></script>

</x-app-layout>
