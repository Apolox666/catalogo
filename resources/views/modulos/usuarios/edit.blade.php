<x-app-layout>
    <x-slot name="header" class="text-black text-3xl p-8 font-bold">
        {{ __('Users') }}
    </x-slot>
    <div class="relative overflow-x-auto p-8">
        <div class="p-4 bg-white rounded-lg shadow-xs">

            <h1 class=" text-black text-3xl p-8 font-bold">Editar usuario</h1>
            <form method="POST" id="edit-form" class="p-6" action="{{ route('user.update', $user->id) }}">
                {{ method_field('PATCH') }}
                @csrf

                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Nombre *')" />
                    <x-text-input id="name"
                        class="block mt-1 w-full {{ $errors->has('name') ? 'border-red-600' : '' }} " type="text"
                        name="name" value="{{ $user->name }}" autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div class="mt-12">
                    <x-input-label for="email" :value="__('Correo *')" />
                    <x-text-input id="email"
                        class="block mt-1 w-full {{ $errors->has('email') ? 'border-red-600' : '' }}" type="text"
                        name="email" value="{{ $user->email }}" autocomplete="username" readonly />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->

                <div class="mt-12">
                    <x-input-label for="password" :value="__('Contraseña *')" />

                    <x-text-input id="password"
                        class="block mt-1 w-full {{ $errors->has('password') ? 'border-red-600' : '' }}" type="password"
                        name="password" autocomplete="new-password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-12">
                    <x-input-label for="password_confirmation" :value="__('Confirmar contraseña *')" />

                    <x-text-input id="password_confirmation"
                        class="block mt-1 w-full {{ $errors->has('password') ? 'border-red-600' : '' }}" type="password"
                        name="password_confirmation" autocomplete="new-password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

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
</x-app-layout>
