<x-app-layout>
   

    <div class="relative overflow-x-auto p-8">
        <div class="p-4 bg-white rounded-lg shadow-xs">
            <h1 class=" text-black text-3xl py-8 font-bold">Registrar un nuevo responsable</h1>
            <form method="POST" class="p-6" action="{{ route('responsible.store') }}">
                @csrf

                <!-- nombre -->
                <div> 
                    <x-input-label for="first_name" :value="__('Primer nombre *')" />
                    <x-text-input id="first_name"
                        class="block mt-6 w-full {{ $errors->has('first_name') ? 'border-red-600' : '' }}" type="text"
                        name="first_name" :value="old('name')"  autofocus autocomplete="name" />

                    @error('first_name')
                        <p class="text-red-500 text-xs">{{ $message }}</p>
                    @enderror
                </div>

                <!-- segundo nombre -->
                <div class="mt-12"> 
                    <x-input-label for="second_name" :value="__('Segundo nombre ')" />
                    <x-text-input id="second_name"
                        class="block mt-6 w-full {{ $errors->has('second_name') ? 'border-red-600' : '' }}" type="text"
                        name="second_name" :value="old('name')"  autofocus autocomplete="name" />

                    @error('second_name')
                        <p class="text-red-500 text-xs">{{ $message }}</p>
                    @enderror
                </div>

                <!-- primer apellido -->
                <div class="mt-12"> 
                    <x-input-label for="first_surname" :value="__('Primer apellido *')" />
                    <x-text-input id="first_surname"
                        class="block mt-6 w-full {{ $errors->has('first_name') ? 'border-red-600' : '' }}" type="text"
                        name="first_surname" :value="old('name')"  autofocus autocomplete="name" />

                    @error('first_name')
                        <p class="text-red-500 text-xs">{{ $message }}</p>
                    @enderror
                </div>

                <!-- segundo apellido -->
                <div class="mt-12"> 
                    <x-input-label for="second_surname" :value="__('Segundo apellido *')" />
                    <x-text-input id="second_surname"
                        class="block mt-6 w-full {{ $errors->has('first_name') ? 'border-red-600' : '' }}" type="text"
                        name="second_surname" :value="old('name')"  autofocus autocomplete="name" />

                    @error('first_name')
                        <p class="text-red-500 text-xs">{{ $message }}</p>
                    @enderror
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
</x-app-layout>
