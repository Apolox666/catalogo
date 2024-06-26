<x-app-layout>


    <div class="relative overflow-x-auto p-8">
        <div class="p-4 bg-white rounded-lg shadow-xs">
            <h1 class=" text-black text-3xl p-8 font-bold">Registrar una actividad</h1>
            <form method="POST" class="p-6" action="{{ route('activity.store') }}">
                @csrf
                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Nombre *')" />
                    <x-text-input id="name"
                        class="block mt-1 w-full {{ $errors->has('name') ? 'border-red-600' : '' }}" type="text"
                        name="name" :value="old('name')" autofocus autocomplete="name" />

                    @error('name')
                        <p class="text-red-500 text-xs">{{ $message }}</p>
                    @enderror
                </div>

                <x-input-label for="time" :value="__('Seleccione el tiempo de respuesta para esta actividad *')" class="pt-8" />
                <div class="mb-4 pt-4">
                    <select name="time_type" id="time_type"
                        class="{{ $errors->has('time_type') ? 'border-red-600' : '' }}">
                        <option value="">Seleccione una opcion</option>
                        <option value="hours">Horas</option>
                        <option value="days">Días</option>
                    </select>
                </div>
                @error('time_type')
                    <p class="text-red-500 text-xs">{{ $message }}</p>
                @enderror

                <div id="time_hours" style="display:none;">
                    <x-input-label for="time_hours" :value="__('Seleccione la cantidad de horas *')" class="pt-4" />
                    <select name="time_hours" class="{{ $errors->has('time_hours') ? 'border-red-600' : '' }}">
                        <option value="">Seleccione una opcion</option>
                        <option value="1 hora">1 hora</option>
                        <option value="2 horas">2 horas</option>
                        <option value="3 horas">3 horas</option>
                        <option value="4 horas">4 horas</option>
                        <option value="5 horas">5 horas</option>
                        <option value="6 horas">6 horas</option>
                        <option value="7 horas">7 horas</option>
                        <option value="8 horas">8 horas</option>
                        <option value="9 horas">9 horas</option>
                        <option value="10 horas">10 horas</option>
                        <option value="11 horas">11 horas</option>
                        <option value="12 horas">12 horas</option>
                        <option value="13 horas">13 horas</option>
                        <option value="14 horas">14 horas</option>
                        <option value="15 horas">15 horas</option>
                        <option value="16 horas">16 horas</option>
                    </select>
                </div>
                @error('time_hours')
                    <p class="text-red-500 text-xs">{{ $message }}</p>
                @enderror

                <div id="time_days" style="display:none;">
                    <x-input-label for="time_days" :value="__('Seleccione la cantidad de días *')" class="pt-4" />
                    <select name="time_days" class="{{ $errors->has('time_days') ? 'border-red-600' : '' }}">
                        <option value="">Seleccione una opcion</option>
                        <option value="1 dia">1 día</option>
                        <option value="2 días">2 días</option>
                        <option value="3 días">3 días</option>
                        <option value="4 días">4 días</option>
                        <option value="5 días">5 días</option>
                        <option value="6 días">6 días</option>
                        <option value="7 días">7 días</option>
                        <option value="8 días">8 días</option>
                        <option value="9 días">9 días</option>
                        <option value="10 días">10 días</option>
                        <option value="11 días">11 días</option>
                        <option value="12 días">12 días</option>
                        <option value="13 días">13 días</option>
                        <option value="14 días">14 días</option>
                        <option value="15 días">15 días</option>
                        <option value="16 días">16 días</option>
                        <option value="17 días">17 días</option>
                        <option value="18 días">18 días</option>
                        <option value="19 días">19 días</option>
                        <option value="20 días">20 días</option>
                        <option value="21 días">21 días</option>
                        <option value="22 días">22 días</option>
                        <option value="23 días">23 días</option>
                        <option value="24 días">24 días</option>
                        <option value="25 días">25 días</option>
                        <option value="26 días">26 días</option>
                        <option value="27 días">27 días</option>
                        <option value="28 días">28 días</option>
                        <option value="29 días">29 días</option>
                        <option value="30 días">30 días</option>
                    </select>
                </div>
                @error('time_days')
                    <p class="text-red-500 text-xs">{{ $message }}</p>
                @enderror

                <x-input-label for="priority" :value="__('Seleccione el impacto o prioridad de esta actividad *')" class="pt-8" />
                <div class="mb-4 pt-4">
                    <select name="priority" id="" class="{{ $errors->has('priority') ? 'border-red-600' : '' }}">
                        
                        <option value="0">Seleccione una opcion</option>
                        <option value="Baja">baja</option>
                        <option value="Minima">Minima</option>
                        <option value="Media">Media</option>
                        <option value="Alta">Alta</option>
                        <option value="Critica">Critica</option>
                    </select>
                    @error('priority')
                        <p class="text-red-500 text-xs">{{ $message }}</p>
                    @enderror
                </div>



                <x-input-label for="name" :value="__('Seleccione a que grupo pertenecerá esta actividad *')" class="pt-8" />
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

    <script src="{{ asset('js/timeselect.js') }}"></script>
    <script src="{{ asset('js/search.js') }}"></script>

</x-app-layout>
