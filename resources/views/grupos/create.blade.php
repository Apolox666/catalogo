<x-app-layout>
    <x-slot name="header">
        {{ __('Users') }}
    </x-slot>

    <div class="relative overflow-x-auto p-8">
        <div class="p-4 bg-white rounded-lg shadow-xs">
            <h1 class=" text-black text-3xl py-8 font-bold">Crear grupo de trabajo</h1>
            <form method="POST" class="p-6" action="{{ route('group.store') }}">
                @csrf

                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Nombre del grupo')" />
                    <x-text-input id="name"
                        class="block mt-6 w-full {{ $errors->has('name') ? 'border-red-600' : '' }}" type="text"
                        name="name" :value="old('name')" autofocus autocomplete="name" />

                    @error('name')
                        <p class="text-red-700 text-xs">{{ $message }}</p>
                    @enderror
                </div>

                <x-input-label for="name" :value="__('Seleccione quienes pertenecerán a este grupo')" class="pt-8" />
                @error('responsibles')
                    <p class="text-red-700 text-xs">{{ $message }}</p>
                @enderror
                @foreach ($responsibles as $responsible)
                    <div class="flex gap-8 pt-10">
                        <div class="flex items-center gap-4">
                            <input type="checkbox"  name="responsibles[]" value="{{ $responsible->id }}">
                            <p>{{ $responsible->name }}</p>
                        </div>
                    </div>
                @endforeach
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
