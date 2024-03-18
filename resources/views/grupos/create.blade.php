<x-app-layout>

    <div class="relative overflow-x-auto p-8">
        <div class="p-8 bg-white rounded-lg shadow-xs">
            <h1 class=" text-black text-3xl py-8 font-bold">Crear grupo de trabajo</h1>
            <form method="POST" class="p-6" action="{{ route('group.store') }}">
                @csrf

                <!-- nombre -->
                <div>
                    <x-input-label for="name" :value="__('Nombre del grupo')" />
                    <x-text-input id="name"
                        class="block mt-6 w-full {{ $errors->has('name') ? 'border-red-600' : '' }}" type="text"
                        name="name" :value="old('name')" autofocus autocomplete="name" />

                    @error('name')
                        <p class="text-red-700 text-xs">{{ $message }}</p>
                    @enderror
                </div>

                <!-- seleccion de responsables -->
                <x-input-label for="name" :value="__('Seleccione quienes pertenecerán a este grupo')" class="pt-8" />
                <div class="mb-4">
                    <input type="text" id="search" class="form-input rounded-md my-4 shadow-sm" placeholder="Buscar por nombre">
                </div>

                @error('responsibles')
                    <p class="text-red-700 text-xs">{{ $message }}</p>
                @enderror
                <div class="flex flex-wrap gap-8" id="responsibles-container">

                    @foreach ($responsibles as $responsible) <!-- Este foreach trae los responsables en chekboxes para mostrarlos en el formulario -->
                        <div class="w-1/4 flex items-center gap-4 search">
                            <input type="checkbox" name="responsibles[]" value="{{ $responsible->id }}">  <!-- mediante [] se estipula que que la informacion es un array -->
                            <p>{{ $responsible->name }}</p>
                        </div>
                    @endforeach
                </div>
                
                <div class="flex items-center justify-end mt-4">
                    <a href="{{ route('group.index') }}">
                        <button
                            class="inline-flex items-center px-4 py-4 bg-red-500 shadow-md border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-400 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Cancelar
                        </button>
                    </a>
                    <x-primary-button class="ms-4">
                        {{ __('Registrar') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
     <script src="{{asset('js/search.js')}}"></script>
</x-app-layout>
