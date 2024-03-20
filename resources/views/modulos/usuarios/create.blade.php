<x-app-layout>
    <x-slot name="header">
        {{ __('Users') }}
    </x-slot>
    <div class="relative overflow-x-auto p-8">
        <div class="p-4 bg-white rounded-lg shadow-xs">
            <h1 class=" text-black text-3xl p-8 font-bold">Crear nuevo usuario</h1>
            <form method="POST" class="p-6" action="{{ route('user.store') }}">
                @csrf

                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Nombre')" />
                    <x-text-input id="name"
                        class="block mt-1 w-full {{ $errors->has('name') ? 'border-red-600' : '' }}" type="text"
                        name="name" :value="old('name')" autofocus autocomplete="name" />

                    @error('name')
                        <p class="text-red-500 text-xs">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email Address -->
                <div class="mt-12">
                    <x-input-label for="email" :value="__('Correo')" />
                    <x-text-input id="email"
                        class="block mt-1 w-full {{ $errors->has('email') ? 'border-red-600' : '' }}" type="email"
                        name="email" :value="old('email')" autocomplete="username" />

                    @error('email')
                        <p class="text-red-500 text-xs">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mt-12">
                    <x-input-label for="password" :value="__('Contraseña')" />
                    <x-text-input id="password"
                        class="block mt-1 w-full {{ $errors->has('password') ? 'border-red-600' : '' }}" type="password"
                        name="password" autocomplete="new-password" />

                    @error('password')
                        <p class="text-red-500 text-xs">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="mt-12">
                    <x-input-label for="password_confirmation" :value="__('Confirmar Contraseña')" />
                    <x-text-input id="password_confirmation"
                        class="block mt-1 w-full {{ $errors->has('password') ? 'border-red-600' : '' }}" type="password"
                        name="password_confirmation" autocomplete="new-password" />

                    @error('password')
                        <p class="text-red-500 text-xs">{{ $message }}</p>
                    @enderror
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



</x-app-layout>
